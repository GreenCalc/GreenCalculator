<?php
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/home.css">
    <title>Kalkulator Jejak Karbon</title>
</head>
<body>
<header>
        <div class="logo">Kalkulator Jejak Karbon</div>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="kalkulator/kalkulator.php">Kalkulator</a>
            <a href="#updates">Update</a>
            <a href="#about">Tentang Kami</a>
            <a href="#guide">Panduan</a>
            <a href="#contact">Kontak</a>
            <a href="user/user.php">User</a>
            <?php if (isset($_SESSION['username'])): ?>
            <span class="username">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <?php endif; ?>
        </nav>
    </header>

    <section class="hero">
        <h1>Cari Tahu Berapa Banyak CO2 Yang Anda Hasilkan Dan Apa Yang Harus Dilakukan Untuk Menguranginya!</h1>
        <button>Hitung Emisi Karbon Kamu</button>
    </section>

    <section class="section leaderboard">
        <h2>3 Peringkat Teratas Mencapai Komitmen Pengurangan Emisi</h2>
        <div class="list-leaderboard">
            <img src="assets/img/zee-banner.jpg">
            <p>1234 ton CO<sub>2</sub>eq/Tahun</p>
        </div>
        <br><br><br><br>
        <div class="list-leaderboard">
            <img src="assets/img/zee-banner.jpg">
            <p>1234 ton CO<sub>2</sub>eq/Tahun</p>
        </div>
        <br>
        <div class="list-leaderboard">
            <img src="assets/img/zee-banner.jpg">
            <p>1234 ton CO<sub>2</sub>eq/Tahun</p>
        </div>
    </section>

    <section class="section calculator" id="calculator">
        <h2>Ayo Cek Emisi Karbon Kamu Sekarang!</h2>
        <p>Langkah awal mengurangi karbon dimulai dari menghitung emisi karbon pribadi.</p>
        <button>Hitung Emisi Karbon Kamu</button>
    </section>

    <section class="section" id="updates">
        <h2>Informasi Terkini</h2>
        <div class="articles">
            <div class="article">
                <h4>Wow Menarik! Ternyata Menghapus Emisi...</h4>
                <p>8 Oktober 2024</p>
            </div>
            <div class="article">
                <h4>Menghadapi Heat Wave: Dampak Perubahan Iklim...</h4>
                <p>17 September 2024</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="subscription-form">
            <input type="email" placeholder="Masukkan email Anda" />
            <button>Submit</button>
        </div>
        <div class="footer-logo">
            <a href="#">Kalkulator Jejak Karbon</a> | Copyright &copy; 2024
        </div>
    </footer>
</body>
</html>
