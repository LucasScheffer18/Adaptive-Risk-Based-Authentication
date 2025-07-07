<?php
// helpers/risco.php
function calcularRisco($ip, $dispositivo, $localizacao) {
    $risco = 0.1;

    $dispositivo = strtolower($dispositivo);

    // IP suspeito
    if (strpos($ip, '192.') !== false) {
        $risco += 0.3;
    }

    // Dispositivo
    if (strpos($dispositivo, 'android') !== false) {
        $risco += 0.1;
    } elseif (strpos($dispositivo, 'iphone') !== false || strpos($dispositivo, 'ios') !== false) {
        $risco += 0.1;
    } elseif (strpos($dispositivo, 'windows') !== false) {
        $risco += 0.2;
    } elseif (strpos($dispositivo, 'linux') !== false || strpos($dispositivo, 'ubuntu') !== false) {
        $risco += 0.2;
    } else {
        $risco += 0.3; // dispositivo desconhecido
    }

    // Localização ausente
    if ($localizacao === 'Desconhecida') {
        $risco += 0.4;
    }

    return min(1, $risco);
}