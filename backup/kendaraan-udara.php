<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Jejak Karbon - Kendaraan Udara</title>
    <link rel="stylesheet" href="assets/css/kalkulator.css">
    <script>
        // Function to handle category selection
        function selectCategory(category) {
            const categories = document.querySelectorAll('.category-option');
            categories.forEach(cat => {
                cat.classList.remove('active');
            });
            document.getElementById(category).classList.add('active');
        }

        // Emisi per km untuk setiap jenis kendaraan (dalam ton CO₂eq/km)
        const flightEmissionFactors = {
    economy: 0.00015,  // contoh emisi ekonomi, 150 gram CO₂/km
    business: 0.0003   // contoh emisi bisnis, 300 gram CO₂/km
};



    </script>
</head>
<body>
    <div class="navbar">
        <nav>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Kalkulator</a></li>
                <li><a href="#">Update</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Panduan</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </nav>
    </div>
    <section class="category-section">
        <h2>Pilih Kategori Penghitungan Jejak Karbon</h2>
        <div class="category-selection">
            <div id="transportasi-darat" class="category-option" onclick="selectCategory('transportasi-darat')">
                <img src="assets\img\ico-vehicle.png" alt="Transportasi Darat">
                <p>Transportasi Darat</p>
            </div>
            <div id="transportasi-udara" class="category-option active" onclick="selectCategory('transportasi-udara')">
                <img src="assets\img\ico-plane.png" alt="Transportasi Udara">
                <p>Transportasi Udara</p>
            </div>
            <div id="daya-rumah" class="category-option" onclick="selectCategory('daya-rumah')">
                <img src="assets\img\ico-energy.png" alt="Daya Rumah Tangga">
                <p>Daya Rumah Tangga</p>
            </div>
            <div id="peralatan-rumah" class="category-option" onclick="selectCategory('peralatan-rumah')">
                <img src="assets\img\ico-microwave.png" alt="Peralatan Rumah Tangga">
                <p>Peralatan Rumah Tangga</p>
            </div>
            <div id="makanan" class="category-option" onclick="selectCategory('makanan')">
                <img src="assets\img\ico-burger.png" alt="Makanan">
                <p>Makanan</p>
            </div>
        </div>
    </section>

    <section class="calculator-section">
        <h2>TRANSPORTASI UDARA</h2>

        <!-- Pilihan Kelas Penerbangan -->
        <div class="input-section">
            <h3>Kelas Penerbangan</h3>
            <div class="flight-class">
                <label>
                    <input type="radio" name="flight-class" value="economy" checked>
                    <img src="economy-class-icon.png" alt="Kelas Ekonomi">
                    <p>Kelas Ekonomi</p>
                </label>
                <label>
                    <input type="radio" name="flight-class" value="business">
                    <img src="business-class-icon.png" alt="Kelas Bisnis">
                    <p>Kelas Bisnis</p>
                </label>
            </div>
        </div>

        <!-- Pilihan Satu-Arah atau Dua-Arah -->
        <div class="input-section">
            <h3>Satu-Arah/Dua-Arah</h3>
            <div class="flight-type">
                <label>
                    <input type="radio" name="flight-type" value="one-way" checked>
                    <img src="one-way-icon.png" alt="One Way">
                    <p>One Way</p>
                </label>
                <label>
                    <input type="radio" name="flight-type" value="round-trip">
                    <img src="round-trip-icon.png" alt="Round Trip">
                    <p>Round Trip</p>
                </label>
            </div>
        </div>

        <!-- Frekuensi Penerbangan -->
        <div class="input-section">
            <h3>Frekuensi Penerbangan Dalam Setahun</h3>
            <div class="flight-frequency">
                <label><input type="radio" name="flight-frequency" value="1" checked> 1</label>
                <label><input type="radio" name="flight-frequency" value="2"> 2</label>
                <label><input type="radio" name="flight-frequency" value="3"> 3</label>
                <label><input type="radio" name="flight-frequency" value="4"> 4</label>
                <label><input type="radio" name="flight-frequency" value="5"> 5</label>
            </div>
        </div>

        <!-- Jarak Penerbangan -->
        <div class="input-section">
            <h3>Jarak Penerbangan (KM/Trip)</h3>
            <input type="range" id="flight-distance" min="0" max="14000" step="500" value="0" oninput="document.getElementById('distance-display').value = this.value">
            <input type="number" id="distance-display" value="0" readonly> km
        </div>

        <!-- Tombol Penghitungan -->
        <button class="calculate-btn" onclick="calculateFlightEmissions()">Hitung Emisi</button>

        <!-- Hasil Emisi -->
        <div class="result">
            <p>Total Emisi: <span>0.00</span> ton CO₂eq</p>
        </div>
    </section>
    <footer>
        <div class="subscribe">
            <h3>Tetap Terhubung Bersama Kami</h3>
            <input type="email" placeholder="Tuliskan Email Kamu">
            <button>Submit</button>
        </div>
        <p>&copy; Copyright 2024, All right reserved by IESR</p>
    </footer>

</body>
</html>
