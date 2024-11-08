<?php
session_start();

// Tampilkan hasil emisi
$emission_land = isset($_SESSION['emission_land']) ? $_SESSION['emission_land'] : 0;
$emission_air = isset($_SESSION['emission_air']) ? $_SESSION['emission_air'] : 0;

$total_emission = $emission_land + $emission_air;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Emisi</title>
</head>
<body>
    <h1>Hasil Emisi Anda</h1>
    <p>Total Emisi Darat: <?php echo $emission_land; ?> Kg CO₂eq</p>
    <p>Total Emisi Udara: <?php echo $emission_air; ?> Kg CO₂eq</p>
    <p>Total Emisi: <?php echo $total_emission; ?> Kg CO₂eq</p>
</body>
</html>
