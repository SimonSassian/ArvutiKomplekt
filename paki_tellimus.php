<?php
require_once('server.php');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$tellimusId = $data["tellimusId"];
pakiTellimus($tellimusId); // või pakiTellimus($tellimusId);
echo json_encode(["message" => "Tellimus komplekteeritud/pakitud!"]);

?>
