<?php
// conf.php

$serverinimi = "d125328.mysql.zonevs.eu";
$kasutajanimi = "d125328_nimetu2";
$parool = "RolandjaSimon21";
$andmebaas = "d125328sd536828";

$yhendus = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaas);

if ($yhendus->connect_error) {
    die("Ühenduse ebaõnnestumine: " . $yhendus->connect_error);
}

$yhendus->set_charset("UTF8");
?>
