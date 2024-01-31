<?php
// Ühendus andmebaasiga
require_once('conf.php');

function loeTellimused() {
    global $yhendus;

    $sql = "SELECT * FROM arvutitellimused";
    $tulemus = $yhendus->query($sql);

    if ($tulemus && $tulemus->num_rows > 0) {
        $tellimused = [];
        while ($rida = $tulemus->fetch_assoc()) {
            $tellimused[] = $rida;
        }
        return $tellimused;
    } else {
        return [];
    }
}

function salvestaTellimus($kirjeldus, $korpus, $kuvar) {
    global $yhendus;

    // Veenduge, et pakitud muutuja on õigesti määratud vormis
    $pakitud = isset($_POST['pakitud']) ? $_POST['pakitud'] : 0;

    $stmt = $yhendus->prepare("INSERT INTO arvutitellimused (kirjeldus, korpus, kuvar, pakitud) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $kirjeldus, $korpus, $kuvar, $pakitud);
    $stmt->execute();
    $stmt->close();
}

function loeKomplekteerimataTellimused() {
    global $yhendus;

    $sql = "SELECT * FROM arvutitellimused WHERE korpus = 0 OR kuvar = 0";
    $tulemus = $yhendus->query($sql);

    if ($tulemus->num_rows > 0) {
        while ($rida = $tulemus->fetch_assoc()) {
            $tellimused[] = $rida;
        }
        return $tellimused;
    } else {
        return [];
    }
}

function loePakitudTellimused() {
    global $yhendus;

    $sql = "SELECT * FROM arvutitellimused WHERE pakitud = 1";
    $tulemus = $yhendus->query($sql);

    if ($tulemus->num_rows > 0) {
        while ($rida = $tulemus->fetch_assoc()) {
            $tellimused[] = $rida;
        }
        return $tellimused;
    } else {
        return [];
    }
}

function komplekteeriTellimus($tellimusId) {
    global $yhendus;

    // Veenduge, et $tellimusId on tervikarv ja mitte tühi
    if (!empty($tellimusId) && is_numeric($tellimusId)) {
        $sql = "UPDATE arvutitellimused SET korpus = 1, kuvar = 1 WHERE id = $tellimusId";

        $yhendus->query($sql);
    }
}

function pakiTellimus($tellimusId) {
    global $yhendus;

    // Veenduge, et $tellimusId on tervikarv ja mitte tühi
    if (!empty($tellimusId) && is_numeric($tellimusId)) {
        $sql = "UPDATE arvutitellimused SET pakitud = 1 WHERE id = $tellimusId";

        $yhendus->query($sql);
    }
}


// Sulgege andmebaasiühendus, kui töö lõpetatakse
register_shutdown_function(function() {
    global $yhendus;
    $yhendus->close();
});
?>
