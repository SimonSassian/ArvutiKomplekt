<?php
require_once('server.php');

$tellimused = loeTellimused();

foreach ($tellimused as $tellimus) {
    echo '<li>' . $tellimus['kirjeldus'] . ' <button onclick="komplekteeriTellimus(' . $tellimus['id'] . ')">Komplekteeri</button></li>';
}
?>
