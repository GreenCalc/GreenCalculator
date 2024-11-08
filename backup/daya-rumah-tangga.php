<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/kalkulator.css">
    <title>Kalkulator Jejak Karbon - daya Rumah Tangga</title>
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
            <div id="transportasi-udara" class="category-option" onclick="selectCategory('transportasi-udara')">
                <img src="assets\img\ico-plane.png" alt="Transportasi Udara">
                <p>Transportasi Udara</p>
            </div>
            <div id="daya-rumah" class="category-option active" onclick="selectCategory('daya-rumah')">
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
        <h2>PERALATAN RUMAH TANGGA</h2>

        <!-- Daftar Peralatan Rumah Tangga -->
        <div class="input-section appliance-list">
            <div class="appliance-item">
                <label for="alat-1">Peralatan 1 (Daya dalam Watt):</label>
                <input type="number" id="alat-1-daya" value="100">
                <label for="alat-1-jam">Lama Pemakaian (jam/hari):</label>
                <input type="number" id="alat-1-jam" value="1">
            </div>
            <div class="appliance-item">
                <label for="alat-2">Peralatan 2 (Daya dalam Watt):</label>
                <input type="number" id="alat-2-daya" value="75">
                <label for="alat-2-jam">Lama Pemakaian (jam/hari):</label>
                <input type="number" id="alat-2-jam" value="1">
            </div>
            <div class="appliance-item">
                <label for="alat-3">Peralatan 3 (Daya dalam Watt):</label>
                <input type="number" id="alat-3-daya" value="200">
                <label for="alat-3-jam">Lama Pemakaian (jam/hari):</label>
                <input type="number" id="alat-3-jam" value="1">
            </div>
        </div>

        <!-- Tombol Hitung -->
        <button class="calculate-btn" onclick="calculateApplianceEmissions()">Hitung Emisi</button>

        <!-- Hasil Emisi -->
        <div class="result">
            <p>Total Emisi Peralatan Rumah Tangga: <span id="appliance-emission">0.00</span> ton CO₂/Tahun</p>
        </div>
    </section>

    <script>
        function calculateApplianceEmissions() {
            // Mengambil data dari input
            const alat1Daya = document.getElementById('alat-1-daya').value;
            const alat1Jam = document.getElementById('alat-1-jam').value;
            const alat2Daya = document.getElementById('alat-2-daya').value;
            const alat2Jam = document.getElementById('alat-2-jam').value;
            const alat3Daya = document.getElementById('alat-3-daya').value;
            const alat3Jam = document.getElementById('alat-3-jam').value;

            // Menghitung konsumsi listrik per tahun dalam kWh
            const alat1Kwh = (alat1Daya * alat1Jam * 365) / 1000;
            const alat2Kwh = (alat2Daya * alat2Jam * 365) / 1000;
            const alat3Kwh = (alat3Daya * alat3Jam * 365) / 1000;

            // Faktor emisi dalam ton CO₂ per kWh
            const emisiPerKwh = 0.7;

            // Total emisi
            const totalEmisi = (alat1Kwh + alat2Kwh + alat3Kwh) * emisiPerKwh;

            // Tampilkan hasil
            document.getElementById('appliance-emission').textContent = totalEmisi.toFixed(2);
        }
    </script>

</body>
</html>
