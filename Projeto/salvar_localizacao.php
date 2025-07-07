<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['latitude'], $data['longitude'])) {
    $_SESSION['localizacao'] = $data['latitude'] . ', ' . $data['longitude'];
}