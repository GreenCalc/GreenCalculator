<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Jejak Karbon</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['username']);
    $username = $isLoggedIn ? $_SESSION['username'] : null;
    ?>
    
    <!-- Navbar -->
    <nav>
        <div class="logo">Kalkulator Jejak Karbon</div>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="kalkulator/kalkulator.php">Kalkulator</a></li>
            <li><a href="#">Update</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Panduan</a></li>
            <li><a href="#">Kontak</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="user/user.php">Hi, <?= htmlspecialchars($username) ?></a></li>
            <?php else: ?>
                <li><a href="auth/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Cari Tahu Berapa Banyak CO2 Yang Anda Hasilkan</h1>
        <p>Dan Apa Yang Harus Dilakukan Untuk Menguranginya!</p>
        <button>Hitung Emisi Karbon Kamu</button>
    </section>

    <!-- Top 3 Rankings -->
    <section class="rankings">
        <h2>3 Peringkat Teratas Mencapai Komitmen Pengurangan Emisi</h2>
        <div class="ranking-items">
            <div class="ranking-item">
                <span class="medal gold"></span>
                <p>Juwita Prihartini</p>
                <p>1,234 ton CO₂eq/Tahun</p>
            </div>
            <div class="ranking-item">
                <span class="medal silver"></span>
                <p>Irwan Irwan</p>
                <p>1,500 ton CO₂eq/Tahun</p>
            </div>
            <div class="ranking-item">
                <span class="medal bronze"></span>
                <p>Rafi Zakaria</p>
                <p>1,650 ton CO₂eq/Tahun</p>
            </div>
        </div>
    </section>

    <!-- Calculator Call to Action -->
    <section class="calculator">
        <h2>Ayo Cek Emisi Karbon Kamu Sekarang!</h2>
        <p>Langkah awal mengurangi karbon dimulai dari menghitung emisi karbon pribadi ...</p>
        <button>Hitung Emisi Karbon Kamu</button>
    </section>

    <!-- Impact Explanation -->
    <section class="impact">
        <h2>4 Dampak Baik Mengurangi Emisi Karbon Kamu</h2>
        <div class="impact-items">
            <div class="impact-item">Pemanasan Global</div>
            <div class="impact-item">Bencana Alam</div>
            <div class="impact-item">Ketersediaan Air</div>
            <div class="impact-item">Isu Kesehatan</div>
        </div>
    </section>

    <!-- Latest Information -->
    <section class="latest-info">
        <h2>Informasi Terkini</h2>
        <div class="info-cards">
            <div class="info-card">
                <h3>28 Oktober 2024</h3>
                <p>Penambangan Pasir Laut: Ancaman ...</p>
            </div>
            <div class="info-card">
                <h3>24 Oktober 2024</h3>
                <p>Karbon Biru: Mengapa Ini Menjadi ...</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© Copyright 2024, All rights reserved by LSR</p>
        <p>Menjaga jejak karbon akan membantu ...</p>
    </footer>

    <!-- JavaScript if needed -->
    <script src="script.js"></script>
</body>
</html>
