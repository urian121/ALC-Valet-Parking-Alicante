<?php
function generarOpcionesDeHora()
{
    $start_time = strtotime('05:00');
    $end_time = strtotime('24:00');
    $interval = 10 * 60; // 10 minutos en segundos

    $options = '';

    for ($time = $start_time; $time <= $end_time; $time += $interval) {
        $hora_militar = date("H:i", $time);

        // Cambiar 00:00 a 24:00
        if ($hora_militar == '00:00') {
            $hora_militar = '24:00';
        }

        $options .= '<option value="' . $hora_militar . '">' . $hora_militar . '</option>';
    }

    return $options;
}
