<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Jejak Karbon</title>
    <link rel="stylesheet" href="assets/css/kalkulator.css">
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
            <div id="daya-rumah" class="category-option" onclick="selectCategory('daya-rumah')">
                <img src="assets\img\ico-energy.png" alt="Daya Rumah Tangga">
                <p>Daya Rumah Tangga</p>
            </div>
            <div id="peralatan-rumah" class="category-option" onclick="selectCategory('peralatan-rumah')">
                <img src="assets\img\ico-microwave.png" alt="Peralatan Rumah Tangga">
                <p>Peralatan Rumah Tangga</p>
            </div>
            <div id="makanan" class="category-option active" onclick="selectCategory('makanan')">
                <img src="assets\img\ico-burger.png" alt="Makanan">
                <p>Makanan</p>
            </div>
        </div>
    </section>
    <div class="container">
        <h1>Kalkulator Jejak Karbon</h1>
        <p>Kamu bisa memilih lebih dari satu (Maksimal 5 pilihan)</p>
        
        <div class="food-options">
            <!-- Opsi Beras -->
            <div class="food-item">
                <label>
                    <input type="checkbox" id="rice-checkbox" value="rice">
                    <img src="assets/img/rice.png" alt="Beras">
                    <p>Beras</p>
                </label>
                <div id="rice-frequency" class="frequency-options">
                    <label><input type="radio" name="rice-frequency" data-emission="0.4"> 1-3 kali per minggu</label>
                    <label><input type="radio" name="rice-frequency" data-emission="0.8"> 4-5 kali per minggu</label>
                    <label><input type="radio" name="rice-frequency" data-emission="1.4"> Setiap Hari</label>
                </div>
            </div>

            <!-- Opsi Seafood -->
            <div class="food-item">
                <label>
                    <input type="checkbox" id="seafood-checkbox" value="seafood">
                    <img src="assets/img/seafood.png" alt="Seafood">
                    <p>Seafood</p>
                </label>
                <div id="seafood-frequency" class="frequency-options">
                    <label><input type="radio" name="seafood-frequency" data-emission="1.5"> 1-3 kali per minggu</label>
                    <label><input type="radio" name="seafood-frequency" data-emission="2.5"> 4-5 kali per minggu</label>
                    <label><input type="radio" name="seafood-frequency" data-emission="4.0"> Setiap Hari</label>
                </div>
            </div>

            <!-- Opsi Unggas -->
            <div class="food-item">
                <label>
                    <input type="checkbox" id="poultry-checkbox" value="poultry">
                    <img src="assets/img/poultry.png" alt="Unggas">
                    <p>Unggas</p>
                </label>
                <div id="poultry-frequency" class="frequency-options">
                    <label><input type="radio" name="poultry-frequency" data-emission="0.8"> 1-3 kali per minggu</label>
                    <label><input type="radio" name="poultry-frequency" data-emission="1.5"> 4-5 kali per minggu</label>
                    <label><input type="radio" name="poultry-frequency" data-emission="2.3"> Setiap Hari</label>
                </div>
            </div>

            <!-- Opsi Domba -->
            <div class="food-item">
                <label>
                    <input type="checkbox" id="lamb-checkbox" value="lamb">
                    <img src="assets/img/lamb.png" alt="Domba">
                    <p>Domba</p>
                </label>
                <div id="lamb-frequency" class="frequency-options">
                    <label><input type="radio" name="lamb-frequency" data-emission="2.0"> 1-3 kali per minggu</label>
                    <label><input type="radio" name="lamb-frequency" data-emission="3.5"> 4-5 kali per minggu</label>
                    <label><input type="radio" name="lamb-frequency" data-emission="5.0"> Setiap Hari</label>
                </div>
            </div>

            <!-- Opsi Sapi -->
            <div class="food-item">
                <label>
                    <input type="checkbox" id="beef-checkbox" value="beef">
                    <img src="assets/img/beef.png" alt="Sapi">
                    <p>Sapi</p>
                </label>
                <div id="beef-frequency" class="frequency-options">
                    <label><input type="radio" name="beef-frequency" data-emission="2.5"> 1-3 kali per minggu</label>
                    <label><input type="radio" name="beef-frequency" data-emission="4.0"> 4-5 kali per minggu</label>
                    <label><input type="radio" name="beef-frequency" data-emission="6.5"> Setiap Hari</label>
                </div>
            </div>

            <!-- Opsi Olahan Susu -->
            <div class="food-item">
                <label>
                    <input type="checkbox" id="dairy-checkbox" value="dairy">
                    <img src="assets/img/dairy.png" alt="Olahan Susu">
                    <p>Olahan Susu</p>
                </label>
                <div id="dairy-frequency" class="frequency-options">
                    <label><input type="radio" name="dairy-frequency" data-emission="0.7"> 1-3 kali per minggu</label>
                    <label><input type="radio" name="dairy-frequency" data-emission="1.3"> 4-5 kali per minggu</label>
                    <label><input type="radio" name="dairy-frequency" data-emission="2.0"> Setiap Hari</label>
                </div>
            </div>
        </div>

        <!-- Tombol Konfirmasi -->
        <button id="confirm-carbon" onclick="calculateCarbonFootprint()">Konfirmasi</button>

        <!-- Hasil Total Emisi Karbon -->
        <div id="carbon-result">
            Total Jejak Karbon: <span id="carbon-output">0</span> kg CO₂ per minggu
        </div>
    </div>

    <script>
    </script>
</body>
</html>
