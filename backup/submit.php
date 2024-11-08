<?php
// Mulai sesi
session_start();

// Koneksi ke database
$host = 'localhost';
$dbname = 'greencalc';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari sesi dan form
    $user = $_SESSION['username']; // Username dari sesi
    $kendaraan = isset($_POST['jenis_kendaraan']) ? $_POST['jenis_kendaraan'] : null; // Ambil data kendaraan dari form
    $bahan_bakar = isset($_POST['jenis_bahan_bakar']) ? $_POST['jenis_bahan_bakar'] : null; // Ambil data bahan bakar dari form
    $jarak = isset($_POST['jarak_tempuh']) ? $_POST['jarak_tempuh'] : null; // Ambil data jarak dari form

    // Buat array untuk menyimpan pesan kesalahan
    $errors = [];

    // Periksa apakah semua variabel tidak null
    if ($user === null) {
        $errors[] = "Pengguna tidak terdaftar.";
    }
    if ($kendaraan === null) {
        $errors[] = "Jenis kendaraan harus dipilih.";
    }
    if ($bahan_bakar === null) {
        $errors[] = "Jenis bahan bakar harus dipilih.";
    }
    if ($jarak === null || $jarak <= 0) {
        $errors[] = "Jarak tempuh harus diisi dan lebih dari 0.";
    }

    // Jika tidak ada kesalahan, lanjutkan untuk menyimpan data
    if (empty($errors)) {
        // Query untuk memasukkan data ke tabel emisi
        $sql = "INSERT INTO emisi (username, kendaraan, bahan_bakar, jarak) VALUES ('$user', '$kendaraan', '$bahan_bakar', '$jarak')";
        
        // Eksekusi query dan cek hasilnya
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Tampilkan pesan kesalahan
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

$conn->close();
?>
