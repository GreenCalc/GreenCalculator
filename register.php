<?php
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

// Mulai sesi
session_start();

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum menyimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $check_sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Query untuk memasukkan user ke tabel
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $username; // Simpan username ke sesi
            header("Location: testing.php"); // Arahkan ke halaman utama setelah registrasi
            exit();
        } else {
            $error = "Terjadi kesalahan saat mendaftar: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="register.css"> <!-- Ganti dengan file CSS Anda -->
</head>
<body>
    <div class="register-container">
        <h2>Registrasi</h2>
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
