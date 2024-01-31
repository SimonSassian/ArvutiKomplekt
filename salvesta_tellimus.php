<?php
require_once('server.php');

header('Content-Type: application/json'); // Määrake vastuse sisutüüp JSON-ks

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Veenduge, et kõik vajalikud väljad on saadaval

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$kirjeldus = $data['kirjeldus'];
$korpus = $data['korpus'];
$kuvar = $data['kuvar'];

salvestaTellimus($kirjeldus, $korpus, $kuvar);

// Vastuse tagastamine JSON-vormingus
echo json_encode(["message" => "Tellimus salvestatud!"]);
}
?>
