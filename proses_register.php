<?php
// Koneksi ke database (gunakan informasi koneksi Anda)
include 'koneksi.php';

// Memeriksa apakah ada data yang dikirimkan melalui form registrasi
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['birthdate'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];

    // Lakukan proses untuk menyimpan data registrasi ke tabel Users
    $query = "INSERT INTO Users (Username, Password_Hash, Full_Name, Email, Address, Phone, Birthdate) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksiku->prepare($query);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sssssss", $username, $hashed_password, $full_name, $email, $address, $phone, $birthdate);

    if ($stmt->execute()) {
        // Registrasi berhasil, Anda dapat mengarahkan pengguna ke halaman login atau halaman sukses registrasi
        header("Location: login.php");
        exit;
    } else {
        // Gagal menyimpan data registrasi, Anda dapat menampilkan pesan kesalahan atau mengarahkan kembali ke halaman registrasi
        header("Location: register.php?error=failed");
        exit;
    }

    $stmt->close();
}

$koneksiku->close();
?>
