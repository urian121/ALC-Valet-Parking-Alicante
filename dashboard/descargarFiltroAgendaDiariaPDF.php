<?php
require_once('../tcpdf/tcpdf.php');
require_once('../config/config.php');

date_default_timezone_set("Europe/Madrid");
$horaEnEspana = date("Y-m-d");

ob_end_clean(); //limpiar la memoria

//Informacion de la Reserva
if (isset($_GET["fechaReserva"])) {
    $fechaReserva = $_GET["fechaReserva"];
    $sqlReserva     = ("SELECT 
            MAX(c.nombre_completo) AS nombre_completo,
            MAX(c.tlf) AS tlf,
			MAX(r.id) AS id_reserva,
            MAX(r.fecha_entrega) AS fecha_entrega,
            MAX(r.hora_entrega) AS hora_entrega,
            MAX(r.fecha_recogida) AS fecha_recogida,
            MAX(r.hora_recogida) AS hora_recogida,
            MAX(r.observacion_cliente) AS observacion_cliente, 
            MAX(r.total_pago_final) AS total_pago_final,
            MAX(r.numero_vuelo_de_vuelta) AS numero_vuelo_de_vuelta,
			MAX(r.total_pago_reserva) AS total_pago_reserva,
            MAX(v.marca_car) AS marca_car,
            MAX(v.modelo_car) AS modelo_car,
            MAX(v.color_car) AS color_car,
            MAX(v.matricula_car) AS matricula_car
        FROM tbl_clientes AS c 
        LEFT JOIN tbl_reservas AS r ON c.idUser = r.id_cliente 
        LEFT JOIN tbl_vehiculos AS v ON r.id_cliente = v.id_cliente 
        WHERE 
            r.fecha_entrega = '$fechaReserva' OR r.fecha_recogida = '$fechaReserva'
        GROUP BY r.id
        ORDER BY 
            CASE 
                WHEN r.fecha_entrega = '$fechaReserva' THEN r.hora_entrega
                ELSE r.hora_recogida
            END ASC,
            CASE 
                WHEN r.fecha_entrega = '$fechaReserva' THEN NULL
                ELSE r.hora_recogida
            END ASC");
    $resulReserva = mysqli_query($con, $sqlReserva);
    if (!$resulReserva) {
        header("Location: https://alcvaletparking.com/");
        exit;
    }
}

class MYPDF extends TCPDF
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 23);
        $this->SetXY(10, 8);
        $this->Cell(0, 0, 'Agenda Diaria Alcvaletparking', 0, 0, 'C');
    }
}

//CREANDO NUEVO DOCUMNETO PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(5, 35, 5);
$pdf->SetHeaderMargin(10);
$pdf->setPrintFooter(false); //Defino el estado del footer
$pdf->setPrintHeader(true); //Defino el estado del Header
$pdf->SetAutoPageBreak(false);

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);


$pdf->AddPage();
$pdf->SetXY(165, 30);
$pdf->SetTextColor(120, 120, 120);
$pdf->Write(0, 'Fecha: ' . date("d/m/Y", strtotime($fechaReserva)));
$pdf->Ln(10);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Times', '', 9);
$html = '
    <table border="0.1px" style="border-collapse: collapse;" cellpadding="2">
        <thead>
            <tr>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">F. Entrada</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">H. Entrada</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">F. Salida</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">H. Salida</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Cliente</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Teléfono</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Matrícula</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Marca - Modelo</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Precio</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Nº Vuelo</th>
                <th style="background-color: #CCCCCC; border: 1px solid #999;">Observación</th>
            </tr>
        </thead>
        <tbody>';

$contador = 0;
$fechaReserva = date("Y-m-d");

while ($reserva = mysqli_fetch_array($resulReserva)) {
    $contador++;
    // $fila_clase = $reserva["fecha_entrega"] == $fechaReserva ? 'verde' : 'amarilla';
    $fila_clase = $reserva["fecha_entrega"] == $fechaReserva ? 'background-color:#bef2be' : 'background-color:#fdfd8b';
    $reserva_id = $reserva["id_reserva"];
    $html .= '
        <tr id="' . $reserva_id . '" class="' . $fila_clase . '" style="' . $fila_clase . '">
            <td class="custom_td">' . date("d/m/Y", strtotime($reserva["fecha_entrega"])) . '</td>
            <td class="custom_td">' . $reserva["hora_entrega"] . '</td>
            <td class="custom_td">' . ($reserva["fecha_recogida"] != 'Sin definir' ? date("d/m/Y", strtotime($reserva["fecha_recogida"])) : $reserva["fecha_recogida"]) . '</td>
            <td class="custom_td">' . $reserva["hora_recogida"] . '</td>
            <td class="custom_td">' . $reserva["nombre_completo"] . '</td>
            <td class="custom_td">' . $reserva["tlf"] . '</td>
            <td class="custom_td">' . $reserva["matricula_car"] . '</td>
            <td class="custom_td">' . $reserva["marca_car"] . " - " . $reserva["modelo_car"] . '</td>
            <td class="custom_td">' . $reserva["total_pago_reserva"] . ' €</td>
            <td>' . $reserva["numero_vuelo_de_vuelta"] . '</td>
            <td>' . $reserva["observacion_cliente"] . '</td>
        </tr>';
}

$html .= '
        </tbody>
    </table>';


$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Reservas ' . date('d_m_Y H_i_s') . '.pdf', 'I');
