<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$host = "localhost";
$user = "firman"; // Pastikan username ini benar
$pass = "firman123"; // Pastikan password ini benar
$db = "greencalc"; // Nama database yang ingin Anda akses

$conn = new mysqli($host, $user, $pass, $db);

// Periksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mulai sesi dan periksa login
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

$user = $_SESSION['username']; // Username dari sesi

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'calculate') {
    // Jika form Transportasi Darat atau Udara di-submit
    if (isset($_POST['kendaraan']) && isset($_POST['jenis_bahan_bakar']) && isset($_POST['jarak_tempuh'])) {
        // Ambil data dari form Transportasi
        $kendaraan = $_POST['kendaraan'];
        $bahan_bakar = $_POST['jenis_bahan_bakar'];
        $jarak = $_POST['jarak_tempuh'];

        // Hitung emisi
        $emisi = 0;
        switch ($kendaraan) {
            case 'Mobil':
                if ($bahan_bakar == 'Bensin') {
                    $emisi_per_km = 0.2;
                    $emisi = $emisi_per_km * $jarak;
                } elseif ($bahan_bakar == 'Diesel') {
                    $emisi_per_km = 0.24;
                    $emisi = $emisi_per_km * $jarak;
                } else {
                    $emisi = null;
                }
                break;
            
            case 'Motor':
                if ($bahan_bakar == 'Bensin') {
                    $emisi_per_km = 0.1;
                    $emisi = $emisi_per_km * $jarak;
                } elseif ($bahan_bakar == 'Listrik') {
                    $emisi = 0;
                } else {
                    $emisi = null;
                }
                break;
                
            case 'Bis':
                if ($bahan_bakar == 'Bensin') {
                    $emisi_per_km = 0.3;
                    $emisi = $emisi_per_km * $jarak;
                } elseif ($bahan_bakar == 'Diesel') {
                    $emisi_per_km = 0.35;
                    $emisi = $emisi_per_km * $jarak;
                } else {
                    $emisi = null;
                }
                break;
            
            case 'Kereta Listrik':
                $emisi = 0;
                break;

            case 'Pesawat':
                // Periksa jenis bahan bakar dan tentukan emisi
                if ($bahan_bakar == 'Jet A') {
                    $emisi_per_km = 2.5;
                    $emisi = $emisi_per_km * $jarak;
                } elseif ($bahan_bakar == 'Avgas') {
                    $emisi_per_km = 3.0;
                    $emisi = $emisi_per_km * $jarak;
                } elseif ($bahan_bakar == 'Biofuel') {
                    $emisi_per_km = 1.8;
                    $emisi = $emisi_per_km * $jarak;
                } elseif ($bahan_bakar == 'Gas Alam') {
                    $emisi_per_km = 2.0;
                    $emisi = $emisi_per_km * $jarak;
                } else {
                    $emisi = null; // Jika bahan bakar tidak valid
                }
                break;
        }

        // Jika emisi valid, simpan ke database
        if ($emisi !== null) {
            // Total emisi sudah dihitung langsung
            $totalEmisi = $emisi;

            // Simpan data ke tabel emisi
            $sql = "INSERT INTO emisi (username, kendaraan, bahan_bakar, jarak, total_emisi) 
                    VALUES ('$user', '$kendaraan', '$bahan_bakar', '$jarak', '$totalEmisi')";
            if ($conn->query($sql) === TRUE) {
                echo json_encode([
                    "status" => "success", 
                    "message" => "Total emisi: " . number_format($totalEmisi, 2) . " kg CO2",
                    "formType" => $kendaraan
                ]);
            } else {
                // Menampilkan pesan kesalahan lebih rinci
                echo json_encode([
                    "status" => "error", 
                    "message" => "Error pada query: " . $sql . "<br>" . $conn->error
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "Jenis bahan bakar atau kendaraan tidak valid."
            ]);
        }
    }
    
    // Jika form Daya Rumah Tangga di-submit
    elseif (isset($_POST['peralatan']) && isset($_POST['jam_pakai'])) {
        $peralatan = $_POST['peralatan'];
        $jam_pakai = $_POST['jam_pakai'];

        // Mengatur nilai emisi per jam untuk tiap peralatan
        switch ($peralatan) {
            case 'Lampu': $emisi_per_jam = 0.05; break;
            case 'Kulkas': $emisi_per_jam = 0.15; break;
            case 'AC': $emisi_per_jam = 0.3; break;
            case 'Mesin Cuci': $emisi_per_jam = 0.2; break;
            default: $emisi_per_jam = 0; break;
        }

        $totalEmisi = $emisi_per_jam * $jam_pakai;

        // Simpan data ke tabel daya_rumah_tangga
        $sql = "INSERT INTO daya_rumah_tangga (username, peralatan, jam_pakai, total_emisi) 
                VALUES ('$user', '$peralatan', '$jam_pakai', '$totalEmisi')";
        if ($conn->query($sql) === TRUE) {
            // Query untuk mendapatkan jumlah total emisi daya rumah tangga untuk pengguna
            $totalDayaEmisiQuery = "SELECT SUM(total_emisi) as total_emisi_rumah_tangga 
                                    FROM daya_rumah_tangga WHERE username='$user'";
            $result = $conn->query($totalDayaEmisiQuery);
            $totalDayaEmisi = $result->fetch_assoc()['total_emisi_rumah_tangga'];
            
            echo json_encode([
                "status" => "success",
                "message" => "Total emisi untuk peralatan ini: " . number_format($totalEmisi, 2) . " kg CO2. 
                              Total emisi daya rumah tangga: " . number_format($totalDayaEmisi, 2) . " kg CO2",
                "formType" => "Daya Rumah Tangga"
            ]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "Error pada query: " . $sql . "<br>" . $conn->error
            ]);
        }
    }

    // Jika form Emisi Makanan di-submit
    elseif (isset($_POST['makanan']) && isset($_POST['jumlah'])) {
        $makanan = $_POST['makanan'];
        $jumlah = $_POST['jumlah'];

        // Mengatur nilai emisi per kg untuk tiap jenis makanan
        switch ($makanan) {
            case 'Daging Sapi': $emisi_per_kg = 27.0; break; // kg CO2 per kg daging sapi
            case 'Daging Ayam': $emisi_per_kg = 6.9; break;  // kg CO2 per kg daging ayam
            case 'Ikan': $emisi_per_kg = 4.0; break;         // kg CO2 per kg ikan
            case 'Sayuran': $emisi_per_kg = 2.0; break;      // kg CO2 per kg sayuran
            case 'Beras': $emisi_per_kg = 2.7; break;        // kg CO2 per kg beras
            case 'Susu': $emisi_per_kg = 1.5; break;         // kg CO2 per kg susu
            default: $emisi_per_kg = 0; break;                // Jika jenis makanan tidak valid
        }

        $totalEmisi = $emisi_per_kg * $jumlah;

        // Simpan data ke tabel emisi_makanan
        $sql = "INSERT INTO emisi_makanan (username, makanan, jumlah, total_emisi) 
                VALUES ('$user', '$makanan', '$jumlah', '$totalEmisi')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                "status" => "success", 
                "message" => "Total emisi makanan: " . number_format($totalEmisi, 2) . " kg CO2",
                "formType" => "Makanan"
            ]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "Error pada query: " . $sql . "<br>" . $conn->error
            ]);
        }
    }

    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/testingbrok.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Kalkulator Jejak Karbon</title>
</head>
<body>
    <style></style>
    <header>
        <h1>Kalkulator Jejak Karbon</h1>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="#" onclick="showForm('form-transportasi-darat')">Kalkulator Darat</a>
            <a href="#" onclick="showForm('form-transportasi-udara')">Kalkulator Udara</a>
            <a href="#" onclick="showForm('form-daya-rumah-tangga')">Daya Rumah Tangga</a>
            <a href="#" onclick="showForm('form-emisi-makanan')">Emisi Makanan</a>
            <span class="greeting">Hello, <?php echo htmlspecialchars($user); ?>!</span>
        </nav>
    </header>

    <main>
        <h2>Pilih Kategori Penghitungan Jejak Karbon</h2>
        <div class="category-container">
            <div class="category-card" onclick="showForm('form-transportasi-darat')">
                <img src="../assets/img/ico-vehicle.png" alt="Transportasi Darat">
                <p>Transportasi Darat</p>
            </div>
            <div class="category-card" onclick="showForm('form-transportasi-udara')">
                <img src="../assets/img/ico-plane.png" alt="Transportasi Udara">
                <p>Transportasi Udara</p>
            </div>
            <div class="category-card" onclick="showForm('form-daya-rumah-tangga')">
                <img src="../assets/img/ico-energy.png" alt="Daya Rumah Tangga">
                <p>Daya Rumah Tangga</p>
            </div>
            <div class="category-card" onclick="showForm('form-emisi-makanan')">
                <img src="../assets/img/ico-burger.png" alt="Emisi Makanan">
                <p>Emisi Makanan</p>
            </div>
        </div>

      <!-- Form Transportasi Darat -->
      <div id="form-transportasi-darat" class="form-container" style="display: none;">
    <h3>Formulir Transportasi Darat</h3>
    <form action="" method="post" id="formDarat">
        <input type="hidden" name="action" value="calculate">
        
        <label for="kendaraan">Kendaraan:</label>
        <div class="selection">
            <label>
                <p>Mobil</p>
                <input type="radio" name="kendaraan" value="Mobil" required onclick="updateFuelOptions('Mobil')">
                <img src="../assets/img/mobil.png" alt="Mobil" class="image-option">
            </label>
            <label>
                <p>Motor</p>
                <input type="radio" name="kendaraan" value="Motor" onclick="updateFuelOptions('Motor')">
                <img src="../assets/img/motor.png" alt="Motor" class="image-option">
            </label>
            <label>
                <p>Bis</p>
                <input type="radio" name="kendaraan" value="Bis" onclick="updateFuelOptions('Bis')">
                <img src="../assets/img/bis.png" alt="Bis" class="image-option">
            </label>
        </div>

        <div class="selection" id="fuelOptions">
            <!-- Pilihan bahan bakar akan diisi oleh JavaScript -->
        </div>

        <label for="jarak_tempuh">Jarak Tempuh (km):</label>
        <input type="number" id="jarak_tempuh" name="jarak_tempuh" required>

        <button type="submit">Hitung Emisi</button>
    </form>
    <br>
    <div id="resultTransportasiDarat"></div>
</div>

<div id="form-transportasi-udara" class="form-container" style="display: none;">
    <h3>Formulir Transportasi Udara</h3>
    <form id="formTransportasiUdara" action="javascript:void(0);" method="post">
        <input type="hidden" name="action" value="calculate">
        
        <label for="pesawat">Pesawat:</label>   
        <select id="pesawat" name="pesawat" required>
            <option value="Pesawat">Pesawat</option>
        </select>

        <label for="jenis_bahan_bakar">Jenis Bahan Bakar:</label>
        <div class="selection">
            <label>
                <p>Jet A</p>
                <input type="radio" name="jenis_bahan_bakar" value="Jet A" required>
                <img src="../assets/img/planefuel.png" alt="Jet A" class="image-option">
            </label>
            <label>
                <p>Avgas</p>
                <input type="radio" name="jenis_bahan_bakar" value="Avgas">
                <img src="../assets/img/avgas.png" alt="Avgas" class="image-option">
            </label>
            <label>
                <p>Biofuel</p>
                <input type="radio" name="jenis_bahan_bakar" value="Biofuel">
                <img src="../assets/img/biofuel.png" alt="Biofuel" class="image-option">
            </label>
            <label>
                <p>Gas Alam</p>
                <input type="radio" name="jenis_bahan_bakar" value="Gas Alam">
                <img src="../assets/img/gas.png" alt="Gas Alam" class="image-option">
            </label>
        </div>

        <label for="jarak_tempuh">Jarak Tempuh (km):</label>
        <input type="number" id="jarak_tempuh" name="jarak_tempuh" required>

        <button type="button" onclick="hitungEmisi()">Hitung Emisi</button>
    </form>

    <div id="resultTransportasiUdara"></div>
</div>


        <!-- Form Daya Rumah Tangga -->
        <div id="form-daya-rumah-tangga" class="form-container" style="display: none;">
            <h3>Formulir Daya Rumah Tangga</h3>
            <form action="" method="post">
                <input type="hidden" name="action" value="calculate">
                <label for="peralatan">Peralatan:</label>
                <div class="selection">
                    <label>
                        <p>Lampu</p>
                        <input type="radio" name="peralatan" value="Lampu" required>
                        <img src="../assets/img/lampu.png" alt="Lampu" class="image-option">
                    </label>
                    <label>
                        <p>Kulkas</p>
                        <input type="radio" name="peralatan" value="Kulkas">
                        <img src="../assets/img/kulkas.png" alt="Kulkas" class="image-option">
                    </label>
                    <label>
                        <p>AC</p>
                        <input type="radio" name="peralatan" value="AC">
                        <img src="../assets/img/ac.png" alt="AC" class="image-option">
                    </label>
                    <label>
                        <p>Mesin Cuci</p>
                        <input type="radio" name="peralatan" value="Mesin Cuci">
                        <img src="../assets/img/mesincuci.png" alt="Mesin Cuci" class="image-option">
                    </label>
                </div>
        
                <label for="jam_pakai">Jam Pakai (jam):</label>
                <input type="number" id="jam_pakai" name="jam_pakai" required>
        
                <button type="submit">Hitung Emisi</button>
            </form>
            <div id="resultDayaRumahTangga"></div>
        </div>
        

        <!-- Form Emisi Makanan -->
        <div id="form-emisi-makanan" class="form-container" style="display: none;">
            <h3>Formulir Emisi Makanan</h3>
            <form action="" method="post">
                <input type="hidden" name="action" value="calculate">
                <label for="makanan">Jenis Makanan:</label>
                <div class="selection">
                    <label>
                        <p>Daging Sapi</p>
                        <input type="radio" name="makanan" value="Daging Sapi" required>
                        <img src="../assets/img/sapi.png" alt="Daging Sapi" class="image-option">
                    </label>
                    <label>
                        <p>Daging Ayam</p>
                        <input type="radio" name="makanan" value="Daging Ayam">
                        <img src="../assets/img/unggas.png" alt="Daging Ayam" class="image-option">
                    </label>
                    <label>
                        <p>Ikan</p>
                        <input type="radio" name="makanan" value="Ikan">
                        <img src="../assets/img/ikan.png" alt="Ikan" class="image-option">
                    </label>
                    <label>
                        <p>Sayuran</p>
                        <input type="radio" name="makanan" value="Sayuran">
                        <img src="../assets/img/sayur.png" alt="Sayuran" class="image-option">
                    </label>
                    <label>
                        <p>Beras</p>
                        <input type="radio" name="makanan" value="Beras">
                        <img src="../assets/img/nasi.png" alt="Beras" class="image-option">
                    </label>
                    <label>
                        <p>Susu</p>
                        <input type="radio" name="makanan" value="Susu">
                        <img src="../assets/img/olahan-susu.png" alt="Susu" class="image-option">
                    </label>
                </div>
        
                <label for="jumlah">Jumlah (kg):</label>
                <input type="number" id="jumlah" name="jumlah" required>
        
                <button type="submit">Hitung Emisi</button>
            </form>
            <div id="resultMakanan"></div>
        </div>
        
    </main>
    <script src="../assets/js/kalkulator.js"></script>
    <script>
        function showForm(formId) {
            $(".form-container").hide(); // Sembunyikan semua formulir
            $("#" + formId).show(); // Tampilkan formulir yang dipilih
        }

        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault(); // Mencegah pengiriman formulir secara default
                $.ajax({
                    url: "", // Kirim ke file ini
                    type: "POST",
                    data: $(this).serialize(), // Ambil data dari formulir
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            if (response.formType == "Daya Rumah Tangga") {
                                $("#resultDayaRumahTangga").html(response.message);
                            } else if (response.formType == "Emisi Makanan") {
                                $("#resultMakanan").html(response.message);
                            } else {
                                $("#resultTransportasiDarat").html(response.message);
                                $("#resultTransportasiUdara").html(response.message);
                            }
                        } else {
                            alert(response.message); // Tampilkan pesan kesalahan
                        }
                    }
                });
            });
        });

        function updateFuelOptions(kendaraan) {
        const fuelOptions = document.getElementById("fuelOptions");
        fuelOptions.innerHTML = ""; // Hapus pilihan bahan bakar sebelumnya

        if (kendaraan === "Mobil") {
            fuelOptions.innerHTML = `
                <label>
                    <p>Bensin</p>
                    <input type="radio" name="jenis_bahan_bakar" value="Bensin" required>
                    <img src="../assets/img/bensin.png" alt="Bensin" class="image-option">
                </label>
                <label>
                    <p>Diesel</p>
                    <input type="radio" name="jenis_bahan_bakar" value="Diesel">
                    <img src="../assets/img/diesel.png" alt="Solar" class="image-option">
                </label>
            `;
        } else if (kendaraan === "Motor") {
            fuelOptions.innerHTML = `
                <label>
                    <p>Bensin</p>
                    <input type="radio" name="jenis_bahan_bakar" value="Bensin" required>
                    <img src="../assets/img/bensin.png" alt="Bensin" class="image-option">
                </label>
                <label>
                    <p>Listrik</p>
                    <input type="radio" name="jenis_bahan_bakar" value="Listrik">
                    <img src="../assets/img/listrik.png" alt="Listrik" class="image-option">
                </label>
            `;
        } else if (kendaraan === "Bis") {
            fuelOptions.innerHTML = `
                <label>
                    <p>Bensin</p>
                    <input type="radio" name="jenis_bahan_bakar" value="Bensin" required>
                    <img src="../assets/img/bensin.png" alt="Bensin" class="image-option">
                </label>
                <label>
                    <p>Diesel</p>
                    <input type="radio" name="jenis_bahan_bakar" value="Diesel">
                    <img src="../assets/img/Diesel.png" alt="Diesel" class="image-option">
                </label>
            `;
        }
    }
    </script>
</body>
</html>
