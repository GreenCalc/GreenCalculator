<?php
include '../config/config.php'; // Menyertakan file koneksi database

session_start(); // Mulai session untuk mengakses user_id

// Cek apakah user_id ada dalam session
if (isset($_SESSION['user_id'])) {
    // Mengambil data emisi terbaru dari pengguna
    $stmt = $pdo->prepare("SELECT * FROM carbon_emissions WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $emission_data = $stmt->fetch();

    if ($emission_data) {
        // Mengambil total emisi dari data yang diambil
        $total_emission = $emission_data['total_emission'];

        // Misalkan ada nilai komitmen pengurangan emisi yang ingin Anda tetapkan
        $commitment_reduction = 1; // Contoh nilai komitmen pengurangan emisi

        // Menghitung pengurangan emisi
        $emission_reduction = $total_emission - $commitment_reduction;

        // Menghitung persentase pengurangan emisi
        $reduction_percentage = ($total_emission > 0) ? ($emission_reduction / $total_emission) * 100 : 0;
    } else {
        // Jika tidak ada data emisi terbaru
        $total_emission = 0;
        $commitment_reduction = 0;
        $emission_reduction = 0;
        $reduction_percentage = 0;
    }
} else {
    echo "User ID is not set in the session.";
    // You can also redirect the user to the login page or show an error message
    // header('Location: login.php');
    // exit();
}

// Optional: Display the database connection status
if ($pdo) {
    echo "Koneksi ke database berhasil.";
} else {
    echo "Gagal terhubung ke database.";
}

// Your existing HTML code follows...
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalkulator Jejak Karbon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    color: #333;
}

header {
    background-color: #fff;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

nav ul {
    display: flex;
    list-style: none;
    justify-content: space-between;
}

nav ul li a {
    text-decoration: none;
    color: #333;
    padding: 10px;
}

main {
    padding: 20px;
}

h1, h2 {
    margin-bottom: 20px;
    color: #333;
}

.calculator {
    text-align: center;
}

.header-content h1 {
    font-size: 24px;
    margin-bottom: 30px;
    color: #4CAF50; /* Green Text */
}

.emission-cards {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.card {
    padding: 20px;
    border-radius: 10px;
    width: 20%;
    color: white;
}

.blue-card {
    background-color: #007bff; /* Blue */
}

.green-card {
    background-color: #28a745; /* Green */
}

.orange-card {
    background-color: #ffc107; /* Orange */
}

.green-percentage {
    background-color: #4CAF50; /* Dark Green */
}

.card h2 {
    font-size: 18px;
    color: #fff;
}

.calculate-btn {
    padding: 15px 25px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
}

.calculate-btn:hover {
    background-color: #45a049;
}

.ranking {
    margin-top: 40px;
    color: #333;
}

footer {
    background-color: #007bff;
    color: white;
    padding: 20px;
    text-align: center;
    margin-top: 50px;
}

footer form {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

footer input {
    padding: 10px;
    border: none;
    border-radius: 5px;
    width: 50%;
    margin-right: 10px;
}

footer button {
    padding: 10px;
    border: none;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.whatsapp-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #25d366;
    color: white;
    padding: 15px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 18px;
}

.whatsapp-btn:hover {
    background-color: #1da850;
}
    </style>

    <header>
        <nav>
            <ul>
                <li><a href="http://localhost/PROJECT/JejakKarbon/index.php">Beranda</a></li>
                <li><a href="#">Kalkulator</a></li>
                <li><a href="#">Update</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Panduan</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="#">ID</a></li>
                <li><a href="#">EN</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="calculator">
            <div class="header-content">
                <h1>Kalkulator Jejak Karbon</h1>
            </div>

            <!-- Emission cards -->
            <div class="card blue-card">
            <h2>Perhitungan Awal Emisi</h2>
            <p><?= number_format($total_emission, 2) ?> Ton CO₂/tahun</p>
            </div>
            <h2>Komitmen Pengurangan Emisi</h2>
                <div class="card green-card">
            </div>
                <p><?= number_format($commitment_reduction, 2) ?> Ton CO₂/tahun</p>
            <h2>Pengurangan Emisi</h2>
                <div class="card orange-card">
            </div>
                <p><?= number_format($emission_reduction, 2) ?> Ton CO₂/tahun</p>
            <h2>Persentase Pengurangan Emisi</h2>
                <div class="card green-percentage">
            </div>
                <p><?= number_format($reduction_percentage, 2) ?>%</p>


            <button class="calculate-btn">Perhitungan Awal Emisi</button>
            <!-- Button Perhitungan Awal Emisi -->

            <!-- Ranking section -->
            <section class="ranking">
                <h2>Anda diperingkat</h2>
                <ul>
                    <li>Peringkat 0: Peringkat Perhitungan Emisi Karbon</li>
                    <li>Peringkat 0: Peringkat Pengurangan Emisi Karbon</li>
                    <li>Peringkat 0: Peringkat Presentase Pengurangan</li>
                </ul>
            </section>
        </section>

        <footer>
            <div class="contact">
                <h2>Tetap Terhubung Bersama Kami</h2>
                <form>
                    <input type="email" placeholder="Tuliskan Email Kamu" />
                    <button type="submit">Submit</button>
                </form>
            </div>
        </footer>
    </main>

    <!-- WhatsApp button -->
    <a href="https://wa.me/yourwhatsapplink" class="whatsapp-btn">Hubungi Kami</a>

</body>
</html>
