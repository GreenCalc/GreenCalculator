
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/kalkulator.css">
    <title>Kalkulator Jejak Karbon</title>
    <style>
        .calculator-section { display: none; }
        .category-option.active { background-color: #007bff; color: white; }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<header>
        <div class="logo">Kalkulator Jejak Karbon</div>
        <nav>
            <a href="../index.php">Beranda</a>
            <a href="kalkulator/kalkulator.php">Kalkulator</a>
            <a href="#updates">Update</a>
            <a href="#about">Tentang Kami</a>
            <a href="#guide">Panduan</a>
            <a href="#contact">Kontak</a>
            <a href="../user/user.php">User</a>
            <?php if (isset($_SESSION['username'])): ?>
            <span class="username">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <?php endif; ?>
        </nav>
    </header>

    <section class="category-section">
        <h2>Pilih Kategori Penghitungan Jejak Karbon</h2>
        <div class="category-selection">
            <div id="transportasi-darat" class="category-option" onclick="selectCategory('section-transportasi-darat')">
                <img src="../assets/img/ico-vehicle.png" alt="Transportasi Darat">
                <p>Transportasi Darat</p>
            </div>
            <div id="transportasi-udara" class="category-option" onclick="selectCategory('section-transportasi-udara')">
                <img src="../assets/img/ico-plane.png" alt="Transportasi Udara">
                <p>Transportasi Udara</p>
            </div>
            <div id="daya-rumah" class="category-option" onclick="selectCategory('section-daya-rumah')">
                <img src="../assets/img/ico-energy.png" alt="Daya Rumah Tangga">
                <p>Daya Rumah Tangga</p>
            </div>
            <div id="peralatan-rumah" class="category-option" onclick="selectCategory('section-peralatan-rumah')">
                <img src="../assets/img/ico-microwave.png" alt="Peralatan Rumah Tangga">
                <p>Peralatan Rumah Tangga</p>
            </div>
            <div id="makanan" class="category-option" onclick="selectCategory('section-makanan')">
                <img src="../assets/img/ico-burger.png" alt="Makanan">
                <p>Makanan</p>
            </div>
        </div>
    </section>

    <section id="section-transportasi-darat" class="calculator-section">
        <h2>Transportasi Darat</h2>
        <form id="carbonCalculator">
            <label for="vehicleType">Pilih Jenis Kendaraan Anda</label>
            <div id="vehicleType" class="vehicle-options">
                <label>
                    <input type="radio" name="vehicleType" value="mobil_bensin" required>
                    <img src="../assets/img/mobil.png" alt="Mobil Bensin" class="vehicle-img">
                    <span>Mobil Bensin</span>
                </label>
                <label>
                    <input type="radio" name="vehicleType" value="mobil_diesel">
                    <img src="../assets/img/pickup.png" alt="Mobil Diesel" class="vehicle-img">
                    <span>Mobil Diesel</span>
                </label>
                <label>
                    <input type="radio" name="vehicleType" value="motor">
                    <img src="../assets/img/motor.png" alt="Motor" class="vehicle-img">
                    <span>Motor</span>
                </label>
                <label>
                    <input type="radio" name="vehicleType" value="bus">
                    <img src="../assets/img/buss.png" alt="Bus" class="vehicle-img">
                    <span>Bus</span>
                </label>
            </div>
    
            <label for="distance">Jarak Tempuh (km):</label>
            <input type="number" id="distance" required min="1" placeholder="Masukkan jarak">
    
            <label for="frequency">Frekuensi Penggunaan:</label>
            <select id="frequency" required>
                <option value="1">Harian</option>
                <option value="7">Mingguan</option>
                <option value="30">Bulanan</option>
                <option value="365">Tahunan</option>
            </select>
            <br>
        </form>
    
        <button class="calculate-btn" onclick="calculateCarbon()">Hitung Emisi</button>
        <div id="result"></div>
    </section>
    
    <!-- Section for Transportasi Udara -->
    <section id="section-transportasi-udara" class="calculator-section" style="display: none;">
        <h2>TRANSPORTASI UDARA</h2>
    
        <!-- Kelas Penerbangan -->
        <div class="input-section">
            <h3>Kelas Penerbangan</h3>
            <div class="flight-class">
                <label>
                    <input type="radio" name="flight-class" value="economy" checked>
                    <img src="../assets/img/icon-kelaseco.png" alt="Kelas Ekonomi">
                    <p>Kelas Ekonomi</p>
                </label>
                <label>
                    <input type="radio" name="flight-class" value="business">
                    <img src="../assets/img/icon-kelasbisnis.png" alt="Kelas Bisnis">
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
                    <img src="../assets/img/icon-oneway.png" alt="One Way">
                    <p>One Way</p>
                </label>
                <label>
                    <input type="radio" name="flight-type" value="round-trip">
                    <img src="../assets/img/icon-roundtrip.png" alt="Round Trip">
                    <p>Round Trip</p>
                </label>
            </div>
        </div>
    
        <br>    

        <div class="input-section">
            <h3>Frekuensi Penerbangan Dalam Setahun</h3>
        </div>
        <!-- Frekuensi Penerbangan -->
        <div class="button-container">
            <button class="pushable" onclick="handleClick(1)">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">1</span>
            </button>            
            <button class="pushable" onclick="handleClick(2)">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">2</span>
            </button>
            <button class="pushable" onclick="handleClick(3)">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">3</span>
            </button>
            <button class="pushable" onclick="handleClick(4)">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">4</span>
            </button>
            <button class="pushable" onclick="handleClick(5)">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">5</span>
            </button>
        </div>
        <br><br>
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
            <p>Total Emisi dalam Setahun: <span>0.00</span> Kg CO₂eq</p>
        </div>        
    </section>
    

    <section id="section-daya-rumah" class="calculator-section" style="display: none;">
        <h2>DAYA RUMAH TANGGA</h2>
        <div class="input-section appliance-list">
            <div class="appliance-item">
                <label for="alat-1">Peralatan 1 (Daya dalam Watt):</label>
                <input type="number" id="alat-1-daya" value="0">
                <label for="alat-1-jam">Lama Pemakaian (jam/hari):</label>
                <input type="number" id="alat-1-jam" value="0">
            </div>
            <div class="appliance-item">
                <label for="alat-2">Peralatan 2 (Daya dalam Watt):</label>
                <input type="number" id="alat-2-daya" value="0">
                <label for="alat-2-jam">Lama Pemakaian (jam/hari):</label>
                <input type="number" id="alat-2-jam" value="0">
            </div>
            <div class="appliance-item">
                <label for="alat-3">Peralatan 3 (Daya dalam Watt):</label>
                <input type="number" id="alat-3-daya" value="0">
                <label for="alat-3-jam">Lama Pemakaian (jam/hari):</label>
                <input type="number" id="alat-3-jam" value="0">
            </div>
        </div>

        <!-- Tombol Hitung -->
        <button class="calculate-btn" onclick="calculateApplianceEmissions()">Hitung Emisi</button>

        <!-- Hasil Emisi -->
        <div class="result">
            <p>Total Emisi Peralatan Rumah Tangga: <span id="appliance-emission">0.00</span> ton CO₂/Tahun</p>
        </div>
    </section>

    <section id="section-peralatan-rumah" class="calculator-section">
        <h2>Kalkulator Emisi Peralatan Rumah Tangga</h2>
    
        <!-- Penerangan Section -->
        <div class="appliance-section">
            <div class="appliance-header">
                <div class="appliance-icon">
                    <img src="https://via.placeholder.com/40" alt="Penerangan Icon">
                </div>
                <div class="appliance-title">
                    <h3>Penerangan</h3>
                </div>
                <div class="appliance-checkbox">
                    <input type="checkbox" id="lighting-checkbox" onclick="toggleOptions('lighting-options')">
                </div>
            </div>
            <div id="lighting-options" class="appliance-options">
                <h4>Jenis lampu yang Kamu gunakan?</h4>
                <div class="lamp-types">
                    <label><input type="radio" name="lamp-type" value="Pijar"> Pijar</label>
                    <label><input type="radio" name="lamp-type" value="Neon"> Neon</label>
                    <label><input type="radio" name="lamp-type" value="LED"> LED</label>
                </div>
                <label>Berapa jumlah lampu yang Kamu gunakan?</label>
                <input type="number" id="lamp-count" min="0" value="0">
                <label>Berapa lama penggunaan rata-rata dalam sehari? (jam/hari)</label>
                <input type="number" id="lamp-usage" min="0" value="0">
            </div>
        </div>
    
        <!-- Pendingin Ruangan Section -->
        <div class="appliance-section">
            <div class="appliance-header">
                <div class="appliance-icon">
                    <img src="https://via.placeholder.com/40" alt="Pendingin Ruangan Icon">
                </div>
                <div class="appliance-title">
                    <h3>Pendingin Ruangan</h3>
                </div>
                <div class="appliance-checkbox">
                    <input type="checkbox" id="ac-checkbox" onclick="toggleOptions('ac-options')">
                </div>
            </div>
            <div id="ac-options" class="appliance-options">
                <label>Apakah sudah menggunakan AC dengan teknologi inverter?</label>
                <div class="radio-group">
                    <label><input type="radio" name="ac-inverter" value="yes"> Ya</label>
                    <label><input type="radio" name="ac-inverter" value="no"> Tidak</label>
                </div>
                <label>Berapa jumlah AC yang digunakan?</label>
                <input type="number" id="ac-count" min="0" value="0">
                <label>Berapa lama penggunaan rata-rata dalam sehari? (jam/hari)</label>
                <input type="number" id="ac-usage" min="0" value="0">
            </div>
        </div>
    
        <!-- Kulkas Section -->
        <div class="appliance-section">
            <div class="appliance-header">
                <div class="appliance-icon">
                    <img src="https://via.placeholder.com/40" alt="Kulkas Icon">
                </div>
                <div class="appliance-title">
                    <h3>Kulkas</h3>
                </div>
                <div class="appliance-checkbox">
                    <input type="checkbox" id="fridge-checkbox" onclick="toggleOptions('fridge-options')">
                </div>
            </div>
            <div id="fridge-options" class="appliance-options">
                <label>Apakah sudah menggunakan Kulkas dengan teknologi inverter?</label>
                <div class="radio-group">
                    <label><input type="radio" name="fridge-inverter" value="yes"> Ya</label>
                    <label><input type="radio" name="fridge-inverter" value="no"> Tidak</label>
                </div>
            </div>
        </div>
    
        <!-- Tombol Hitung -->
        <button class="calculate-btn" onclick="calculateApplianceEmissions()">Hitung Emisi</button>
    
        <!-- Hasil Emisi -->
        <div class="result">
            <p>Total Emisi Peralatan Rumah Tangga: <span id="appliance-emission">0.00</span> ton CO₂/Tahun</p>
        </div>  
    </section>
    

    <section id="section-makanan" class="calculator-section">
        <h2>MAKANAN</h2>
        <p>Kamu bisa memilih lebih dari satu (Maksimal 5 pilihan)</p>
    
        <div class="food-selection">
            <!-- Telur -->
            <div class="food-item">
                <img src="../assets/img/telur.png" alt="Telur" class="food-icon">
                <label for="egg-checkbox">Telur</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="egg-checkbox" onclick="toggleFrequencyOptions('frequency-options-egg')">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div id="frequency-options-egg" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-egg" value="1-3" id="frequency-egg-1-3">
                    <label for="frequency-egg-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-egg" value="4-5" id="frequency-egg-4-5">
                    <label for="frequency-egg-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-egg" value="every-day" id="frequency-egg-every-day">
                    <label for="frequency-egg-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Susu -->
            <div class="food-item">
                <img src="../assets/img/susu.png" alt="Susu" class="food-icon">
                <label for="milk-checkbox">Susu</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="milk-checkbox" onclick="toggleFrequencyOptions('frequency-options-milk')">
                    <span class="checkmark"></span>
                </label>
                </div>
            <div id="frequency-options-milk" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-milk" value="1-3" id="frequency-milk-1-3">
                    <label for="frequency-milk-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-milk" value="4-5" id="frequency-milk-4-5">
                    <label for="frequency-milk-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-milk" value="every-day" id="frequency-milk-every-day">
                    <label for="frequency-milk-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Beras -->
            <div class="food-item">
                <img src="../assets/img/nasi.png" alt="Beras" class="food-icon">
                <label for="rice-checkbox">Nasi</label>
                <label class="ultra-modern-checkbox">
                <input type="checkbox" id="rice-checkbox" onclick="toggleFrequencyOptions('frequency-options-rice')">
                <span class="checkmark"></span>
            </label>
            </div>
            <div id="frequency-options-rice" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-rice" value="1-3" id="frequency-rice-1-3">
                    <label for="frequency-rice-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-rice" value="4-5" id="frequency-rice-4-5">
                    <label for="frequency-rice-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-rice" value="every-day" id="frequency-rice-every-day">
                    <label for="frequency-rice-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Seafood -->
            <div class="food-item">
                <img src="../assets/img/seafood.png" alt="Seafood" class="food-icon">
                <label for="seafood-checkbox">Seafood</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="seafood-checkbox" onclick="toggleFrequencyOptions('frequency-options-seafood')">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div id="frequency-options-seafood" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-seafood" value="1-3" id="frequency-seafood-1-3">
                    <label for="frequency-seafood-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-seafood" value="4-5" id="frequency-seafood-4-5">
                    <label for="frequency-seafood-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-seafood" value="every-day" id="frequency-seafood-every-day">
                    <label for="frequency-seafood-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Unggas -->
            <div class="food-item">
                <img src="../assets/img/unggas.png" alt="Unggas" class="food-icon">
                <label for="poultry-checkbox">Unggas</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="poultry-checkbox" onclick="toggleFrequencyOptions('frequency-options-poultry')">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div id="frequency-options-poultry" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-poultry" value="1-3" id="frequency-poultry-1-3">
                    <label for="frequency-poultry-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-poultry" value="4-5" id="frequency-poultry-4-5">
                    <label for="frequency-poultry-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-poultry" value="every-day" id="frequency-poultry-every-day">
                    <label for="frequency-poultry-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Domba -->
            <div class="food-item">
                <img src="../assets/img/domba.png" alt="Domba" class="food-icon">
                <label for="lamb-checkbox">Domba</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="lamb-checkbox" onclick="toggleFrequencyOptions('frequency-options-lamb')">
                    <span class="checkmark"></span>
                </label>
               </div>
            <div id="frequency-options-lamb" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-lamb" value="1-3" id="frequency-lamb-1-3">
                    <label for="frequency-lamb-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-lamb" value="4-5" id="frequency-lamb-4-5">
                    <label for="frequency-lamb-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-lamb" value="every-day" id="frequency-lamb-every-day">
                    <label for="frequency-lamb-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Sapi -->
            <div class="food-item">
                <img src="../assets/img/sapi.png" alt="Sapi" class="food-icon">
                <label for="beef-checkbox">Sapi</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="beef-checkbox" onclick="toggleFrequencyOptions('frequency-options-beef')">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div id="frequency-options-beef" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-beef" value="1-3" id="frequency-beef-1-3">
                    <label for="frequency-beef-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-beef" value="4-5" id="frequency-beef-4-5">
                    <label for="frequency-beef-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-beef" value="every-day" id="frequency-beef-every-day">
                    <label for="frequency-beef-every-day">Setiap Hari</label>
                </div>
            </div>
            <br><br>
            <!-- Olahan Susu -->
            <div class="food-item">
                <img src="../assets/img/olahan-susu.png" alt="Olahan Susu" class="food-icon">
                <label for="dairy-products-checkbox">Olahan Susu</label>
                <label class="ultra-modern-checkbox">
                    <input type="checkbox" id="dairy-products-checkbox" onclick="toggleFrequencyOptions('frequency-options-dairy-products')">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div id="frequency-options-dairy-products" class="frequency-options" style="display: none;">
                <label class="frequency-label">Frekuensi (Seminggu)?</label>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-dairy-products" value="1-3" id="frequency-dairy-products-1-3">
                    <label for="frequency-dairy-products-1-3">1-3 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-dairy-products" value="4-5" id="frequency-dairy-products-4-5">
                    <label for="frequency-dairy-products-4-5">4-5 kali per minggu</label>
                </div>
                <div class="frequency-choice">
                    <input type="radio" name="frequency-dairy-products" value="every-day" id="frequency-dairy-products-every-day">
                    <label for="frequency-dairy-products-every-day">Setiap Hari</label>
                </div>
            </div>
        </div>
    
        <button class="calculate-btn" onclick="calculateEmissions()">Hitung Emisi</button>
    
        <div class="result">
            <p>Total Emisi Makanan: <span id="food-emission-result">0.00</span> Kg CO₂eq</p>
        </div>
    </section>
            </body>
            <script>
function saveEmissionData(type, emissionValue) {
    $.ajax({
        url: 'save_emission.php',
        type: 'POST',
        data: {
            type: type,
            emission: emissionValue
        },
        success: function(response) {
            alert("Emission data saved successfully!");
        },
        error: function(xhr, status, error) {
            console.error("Error saving data: " + error);
        }
    });
}
</script>
<script src="../assets/js/function.js"></script>
</html>
