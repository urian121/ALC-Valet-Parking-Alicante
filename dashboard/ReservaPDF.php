<?php
require_once('../tcpdf/tcpdf.php');
require_once('../config/config.php');

date_default_timezone_set("Europe/Madrid");
$horaEnEspana = date("Y-m-d");

ob_end_clean(); //limpiar la memoria

//Informacion de la Reserva
if (isset($_GET["idReserva"])) {
    $idReserva = $_GET["idReserva"];
    $sqlReserva     = ("SELECT 
					    c.*,
                        r.*,
                        v.*
                   FROM tbl_clientes AS c 
                	  INNER JOIN tbl_reservas AS r ON c.idUser=r.id_cliente            
                   INNER JOIN tbl_vehiculos AS v
                   ON r.id_cliente = v.id_cliente
                   WHERE r.id='$idReserva' LIMIT 1");
    $resulReserva = mysqli_query($con, $sqlReserva);
    if (!$resulReserva) {
        header("Location: https://alcvaletparking.com/");
        exit;
    }
    $rowReserva = mysqli_fetch_assoc($resulReserva);
} else {
    header("Location: https://alcvaletparking.com/");
    exit;
}



class MYPDF extends TCPDF
{
    private function traducirDia($nombreDiaEnIngles)
    {
        $traducciones = array(
            'Monday'    => 'Lunes',
            'Tuesday'   => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday'  => 'Jueves',
            'Friday'    => 'Viernes',
            'Saturday'  => 'Sábado',
            'Sunday'    => 'Domingo',
        );

        return $traducciones[$nombreDiaEnIngles] ?? $nombreDiaEnIngles;
    }

    private function traducirMes($nombreMesEnIngles)
    {
        $traducciones = array(
            'January'   => 'Enero',
            'February'  => 'Febrero',
            'March'     => 'Marzo',
            'April'     => 'Abril',
            'May'       => 'Mayo',
            'June'      => 'Junio',
            'July'      => 'Julio',
            'August'    => 'Agosto',
            'September' => 'Septiembre',
            'October'   => 'Octubre',
            'November'  => 'Noviembre',
            'December'  => 'Diciembre',
        );

        return $traducciones[$nombreMesEnIngles] ?? $nombreMesEnIngles;
    }
    public function Header()
    {
        $watermarkImg = dirname(__FILE__) . '/../assets/custom/imgs/esqueleto_vehiculo.png'; // Ruta de la imagen de la marca de agua
        //$this->Image($watermarkImg, 90, 110, 30, 0, 'PNG', '', '', false, 300, '', false, false, 0);
        $this->Image($watermarkImg, 105, 140, 90, 0, 'PNG', '', '', false, 300, '', false, false, 0);

        $fechaActual = new DateTime();
        $nombreDia = $this->traducirDia($fechaActual->format('l'));
        $nombreMes = $this->traducirMes($fechaActual->format('F'));
        $fechaFormateada = $nombreDia . ', ' . $fechaActual->format('j') . ' de ' . $nombreMes . ' del ' . $fechaActual->format('Y');



        $path = dirname(__FILE__);
        $logo = $path . '/../assets/custom/imgs/logo_parking.png'; // Asegúrate de que el separador de directorios esté correcto

        /** Logo Derecha */
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = dirname(__FILE__) . '/../assets/custom/imgs/logon_alcvaletparking.png';
        $this->Image($img_file, 140, 23, 30, 30, '', '', '', false, 30, '', false, false, 0);
        $this->Image($logo, 175, 22, 25);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();

        $this->SetFont('Times', '', 12);
        $this->SetXY(18, 12);
        $this->Cell(180, 0, $fechaFormateada, 0, 0, 'R');

        $recibo = "4328";
        $this->SetFont('helvetica', 'B', 15);
        $this->SetXY(30, 20);
        $this->Cell(150, 80, 'Recibo Nº: ' . $recibo, 0, 0, 'R');


        $this->SetFont('helvetica', 'B', 23);
        $this->SetXY(10, 8);
        $this->Cell(0, 0, 'Recibo de Aparcamiento', 0, 0, 'L');

        $this->SetFont('Times', '', 12);
        $this->SetXY(10, 20);
        $this->Cell(0, 0, 'ALC VALET PARKING', 0, 1, 'L'); // Cambié el último parámetro a 1

        $this->SetX(10);
        $this->Cell(0, 0, 'E72706781', 0, 1, 'L');

        $this->SetX(10);
        $this->Cell(0, 0, 'Ctra. Aeropuerto-Torellano s/n CV-852', 0, 1, 'L');

        $this->SetX(10);
        $this->Cell(0, 0, '03320 Torrellano(Alicante)', 0, 1, 'L');

        $this->SetX(10);
        $this->Cell(0, 0, 'Oficina +34 966 109 228', 0, 1, 'L');

        $this->SetX(10);
        $this->Cell(0, 0, 'Movil +34 601 356 356', 0, 1, 'L');

        $this->SetX(10);
        $this->Cell(0, 0, 'info@alcvaletparking.com', 0, 1, 'L');

        $this->SetX(10);
        $this->Cell(0, 0, 'www.alcvaletparking.com', 0, 1, 'L');

        //Linea Horizontal
        $this->Line(10, 70, 200, 70); // Cambia los valores según tu diseño
    }
}




//CREANDO NUEVO DOCUMNETO PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//establecer margenes
$pdf->SetMargins(25, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false); //Defino el estado del footer
$pdf->setPrintHeader(true); //Defino el estado del Header
$pdf->SetAutoPageBreak(false);

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);


// add a page
$pdf->AddPage();

$idUser = $rowReserva["idUser"];
if ($idUser < 10) {
    $idUser = 'C-00' . $idUser;
} elseif ($idUser < 100) {
    $idUser = 'C-0' . $idUser;
} else {
    $idUser = 'C-' . $idUser;
}

$pdf->Ln(28);
$cliente = array(
    'Código Cliente' => $idUser,
    'Cliente' => $rowReserva["nombre_completo"],
    'DNI / CIF' => $rowReserva["din"],
    'Dirección completa' => $rowReserva["direccion_completa"],
    'Teléfono' => $rowReserva["tlf"],
    'Terminal de entrega' => $rowReserva['terminal_entrega'],
    'Terminal de recogida' => $rowReserva['terminal_recogida'],
);

// Configuración de la fuente
$pdf->SetFont('Helvetica', 'B', 9);
// Configuración de la tabla
$anchoColumna1 = 60;
$anchoColumna2 = 80;
$altoCelda = 7;

// Establecer posición inicial de la tabla
$posicionX = 10;
$posicionY = $pdf->GetY() + 17;

// Crear tabla
foreach ($cliente as $campo => $valor) {
    $pdf->SetXY($posicionX, $posicionY);
    // Configurar fuente y agregar clave sin bordes
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell($anchoColumna1, $altoCelda, $campo, 0);

    // Cambiar la fuente para el valor (no negrita) y agregar valor sin bordes
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell($anchoColumna2, $altoCelda, $valor, 0);
    $posicionY += $altoCelda; // Ajustar la posición Y para la siguiente fila
}
$pdf->SetXY($posicionX, $posicionY + 1);
//Linea Horizontal
$pdf->Line(10, 133, 200, 133);


#Informacion del Vehiculo
$reservaDatos = array(
    'Marca y Modelo' => $rowReserva["marca_car"] . ' ' . $rowReserva["modelo_car"],
    'Color' => $rowReserva["color_car"],
    'Matrícula' => $rowReserva["matricula_car"],
    'Fecha Entrada' => date("d/m/Y", strtotime($rowReserva["fecha_entrega"])),
    'Hora Entrada' => $rowReserva["hora_entrega"],
    'Fecha Salida' => $rowReserva["fecha_recogida"] != 'Sin definir' ? date("d/m/Y", strtotime($rowReserva["fecha_recogida"])) : $rowReserva["fecha_recogida"],
    'Hora Salida' => $rowReserva["hora_recogida"],
    'Nº Vuelo de Vuelta:' => $rowReserva['numero_vuelo_de_vuelta'],
    'Número Días' => $rowReserva["total_dias_reserva"],
    'Forma de Pago' => $rowReserva["formato_pago"],
);


$anchoColumna1 = 60;
$anchoColumna2 = 80;
$altoCelda = 6;
$posicionX = 10;
$posicionY = $pdf->GetY() + 10;
foreach ($reservaDatos as $campo => $valor) {
    $pdf->SetXY($posicionX, $posicionY);
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell($anchoColumna1, $altoCelda, $campo, 0, 0, 'L'); // Sin borde
    // Cambiar la fuente para el valor (no negrita)
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell($anchoColumna2, $altoCelda, $valor, 0, 1, 'L'); // Sin borde y salto de línea
    $posicionY += $altoCelda; // Ajustar la posición Y para la siguiente fila
}
$pdf->SetXY($posicionX, $posicionY + 1);


// Calcular el precio real sin IVA
$precioConIva = ($rowReserva['total_pago_reserva']); // Precio del producto con IVA


$serv1 = $rowReserva['servicios_extras1'] ? $rowReserva['servicios_extras1'] . ' - ' . number_format($rowReserva['total_gasto_extras1'], 2) . ' €' : '';
$serv2 = $rowReserva['servicios_extras2'] ? $rowReserva['servicios_extras2'] . ' - ' . number_format($rowReserva['total_gasto_extras2'], 2) . ' €' : '';
$serv3 = $rowReserva['servicios_extras3'] ? $rowReserva['servicios_extras3'] . ' - ' . number_format($rowReserva['total_gasto_extras3'], 2) . ' €' : '';

$deudaTotal = 0;
for ($i = 1; $i <= 3; $i++) {
    $total_gasto_extra = isset($rowReserva["total_gasto_extras{$i}"]) ? trim($rowReserva["total_gasto_extras{$i}"]) : 0;
    if ($total_gasto_extra !== "") {
        $deudaTotal = number_format(($deudaTotal + $total_gasto_extra), 2, '.', '');
    }
}

$deudaFinal = number_format($deudaTotal + $precioConIva, 2, '.', '');

$tablaDatos1 = array(
    'Precio Estancia' => number_format($precioConIva, 2) . ' €',
    $rowReserva['tipo_plaza'] => '0,00 €',
    $serv1 ? 'Servicio  1' : ''  =>  $serv1,
    $serv2 ? 'Servicio  2' : ''  =>  $serv2,
    $serv3 ? 'Servicio  3' : ''  =>  $serv3,
    'SUMA TOTAL' => number_format($deudaFinal, 2) . ' €',
);

// Configuración de la tabla
$anchoColumna1 = 60;
$anchoColumna2 = 40;
$altoCelda = 6;

// Establecer posición inicial de la primera tabla
$posicionX1 = 10;
$posicionY1 = $pdf->GetY() + 10;

$pdf->SetDrawColor(169, 169, 169);
$pdf->Rect($posicionX1, $posicionY1, $anchoColumna1 + $anchoColumna2, count($tablaDatos1) * $altoCelda);

// Crear primera tabla
foreach ($tablaDatos1 as $concepto => $valor) {
    $pdf->SetXY($posicionX1, $posicionY1);
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell($anchoColumna1, $altoCelda, $concepto, 0, 0, 'L'); // Sin bordes
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell($anchoColumna2, $altoCelda, $valor, 0, 1, 'R'); // Sin bordes
    $posicionY1 += $altoCelda; // Ajustar la posición Y para la siguiente fila
}


/**
 *  Observaciones
 */
$pdf->SetFont('Helvetica', '', 14);
$pdf->SetXY(143, 204);
$pdf->Cell(10, 0, 'Observaciones', 0, 0, 'R');

$obs = trim($rowReserva['observacion_cliente']) ? trim($rowReserva['observacion_cliente']) : '';
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(120, 210);

if (!empty($obs)) {
    $pdf->MultiCell(80, 50, $obs, 1, 'L');
} else {
    $pdf->MultiCell(80, 32, '     ', 1, 'L');
}



// Texto en la parte inferior izquierda
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->SetXY(10, 270); // Ajusta las coordenadas según sea necesario
$pdf->Cell(0, 0, 'Conforme Cliente', 0, 0, 'L');

$pdf->SetXY(50, 270);
$pdf->MultiCell(50, 18, '     ', 1, 'L');

// Texto en la parte inferior derecha
$pdf->SetXY(120, 270); // Ajusta las coordenadas según sea necesario
$pdf->Cell(0, 0, 'Conforme ALC', 0, 0, 'L');
$pdf->SetXY(155, 270);
$pdf->MultiCell(45, 18, '     ', 1, 'L');

//D en lugar de I para forzar la descarga
$pdf->Output('Reserva ' . $rowReserva["nombre_completo"] . ' ' . date('d_m_Y') . '.pdf', 'I');
