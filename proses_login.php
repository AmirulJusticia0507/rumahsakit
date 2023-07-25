<?php
// Memulai sesi untuk menyimpan data CAPTCHA
session_start();

// Fungsi untuk memverifikasi jawaban CAPTCHA
function verifyCaptcha($userInput)
{
    // Mengambil nilai CAPTCHA dari sesi
    $captchaText = $_SESSION['captcha'];

    // Menghapus data CAPTCHA dari sesi (sekali pakai)
    unset($_SESSION['captcha']);

    // Membandingkan jawaban CAPTCHA dengan input pengguna
    return strtolower($captchaText) === strtolower($userInput);
}

include 'koneksi.php';

// Memeriksa apakah koneksi berhasil
if ($koneksiku->connect_errno) {
    die("Failed to connect to MySQL: " . $koneksiku->connect_error);
}

// Mendapatkan data dari form login
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captchaInput = $_POST['captcha'];

    // Memverifikasi jawaban CAPTCHA
    if (!verifyCaptcha($captchaInput)) {
        // Jika CAPTCHA tidak cocok, kembalikan pesan kesalahan
        header("Location: login.php?error=captcha");
        exit;
    }

    // Melakukan query untuk memeriksa login di tabel Users
    $query = "SELECT * FROM Users WHERE Username = ? AND Password_Hash = ?";
    $stmt = $koneksiku->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah login berhasil
    if ($result->num_rows === 1) {
        // Login berhasil
        // Anda dapat menambahkan logika lain yang sesuai dengan kebutuhan Anda
        echo "Login berhasil!";
    } else {
        // Login gagal
        header("Location: login.php?error=failed");
        exit;
    }

    $stmt->close();
}

$koneksiku->close();
?>
