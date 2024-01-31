<?php
require_once('server.php');

// Lae kõik tellimused
$tellimused = loeTellimused();

// Loenda tellimuste arv
$kokkuTellimusi = count($tellimused);

// Loenda pakitud tellimuste arv
$pakitudTellimusi = 0;
foreach ($tellimused as $tellimus) {
    if ($tellimus['pakitud'] == 1) {
        $pakitudTellimusi++;
    }
}

// Loenda komplekteeritud tellimuste arv
$komplekteeritudTellimusi = 0;
foreach ($tellimused as $tellimus) {
    if ($tellimus['korpus'] == 1) {
        $komplekteeritudTellimusi++;
    }
}

// Arvuta tegemata tellimuste arv
$tegemataTellimusi = $kokkuTellimusi - $pakitudTellimusi;

?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistika</title>
</head>
<body>
    <h1>Statistika</h1>
    <p>Kokku tellimusi: <?php echo $kokkuTellimusi; ?></p>
    <p>Pakitud tellimusi: <?php echo $pakitudTellimusi; ?></p>
    <p>Komplekteeritud tellimusi: <?php echo $komplekteeritudTellimusi; ?></p>
    <p>Tegemata tellimusi: <?php echo $tegemataTellimusi; ?></p>
</body>
</html>
