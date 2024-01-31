<?php
session_start();
require_once('conf.php');
require_once('server.php');

// Laadige tellimuste andmed
$tellimused = loeTellimused();

// Veenduge, et $tellimused on alati massiiv, isegi kui andmeid pole
if (!is_array($tellimused)) {
    $tellimused = [];
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <title>Tellimuste Haldus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Tellimuste Haldus</h1>

<div id="tellimusteVorm">
    <form action="index.php" method="post">
        <label for="kirjeldus">Kirjeldus:</label>
        <input type="text" id="kirjeldus" name="kirjeldus" required>

        <label for="korpus">Korpus komplekteeritud (1) või mitte (0):</label>
        <input type="number" id="korpus" name="korpus" min="0" max="1" required>

        <label for="kuvar">Kuvar komplekteeritud (1) või mitte (0):</label>
        <input type="number" id="kuvar" name="kuvar" min="0" max="1" required>

        <!-- Peidetud väli "pakitud" -->
        <input type="hidden" id="pakitud" name="pakitud" value="1">

        <button onclick="setTimeout(() => window.location.reload(), 1000)" type="submit">Salvesta Tellimus</button>
    </form>
</div>

<div id="komplekteerimataTellimused">
    <h2>Komplekteerimata Tellimused</h2>
    <ul id="tellimusteNimekiri">
        <?php
        foreach ($tellimused as $tellimus) {
            if ($tellimus['korpus'] == 0 || $tellimus['kuvar'] == 0) {
                echo '<li>' . $tellimus['kirjeldus'] . ' <button onclick="komplekteeriTellimus(' . $tellimus['id'] . '); setTimeout(() => window.location.reload(), 1000)">Komplekteeri</button></li>';
            }
        }
        ?>
    </ul>
</div>

<div id="komplekteeritudTellimused">
    <h2>Komplekteeritud Tellimused</h2>
    <ul id="komplekteeritudTellimusteNimekiri">
        <?php
        foreach ($tellimused as $tellimus) {
            if ($tellimus['korpus'] == 1 && $tellimus['kuvar'] == 1 && $tellimus["pakitud"] == 0) {
                echo '<li>' . $tellimus['kirjeldus'] . ' <button onclick="pakiTellimus(' . $tellimus['id'] . '); setTimeout(() => window.location.reload(), 1000)">Paki</button></li>';
            }
        }
        ?>
    </ul>
</div>

<div id="pakitudLehed">
    <h2>Pakitud Lehed</h2>
    <ul id="pakitudNimekiri">
        <?php
        foreach ($tellimused as $tellimus) {
            if ($tellimus['pakitud'] == 1) {
                echo '<li>' . $tellimus['kirjeldus'] . '</li>';
            }
        }
        ?>
    </ul>
</div>

<div id="statistikaleht">
    <p id="statistika"></p>
    <?php require_once("statistika.php") ?>
</div>

<!-- Skripti lisamine -->
<script src="script.js"></script>
<!-- Skriptid, mis tegelevad tellimuste pakkimise ja komplekteerimisega -->
<script src="komplekteeri_tellimus.js"></script>
<script src="paki_tellimus.js"></script>
<!-- Skript, mis värskendab tellimuste nimekirja -->
<script src="lae_nimekiri.js"></script>
<!-- Skript, mis salvestab tellimuse -->
<script src="salvesta_tellimus.js"></script>
</body>
</html>
