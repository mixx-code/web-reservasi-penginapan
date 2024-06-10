<?php
// Panggil file koneksi ke database
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap dan sanitasi data dari form registrasi
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid.'); window.location.href='../../pages/main_layout.php?page=sign-up';</script>";
        // echo "<script>alert('Format email tidak valid.'); window.location.href='../../pages/registrasi/index.php';</script>";
        exit();
    }

    // Validasi bahwa semua field wajib diisi
    if (empty($fullname) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        echo "<script>alert('Semua field wajib diisi.'); window.location.href='../../pages/main_layout.php?page=sign-up';</script>";
        // echo "<script>alert('Semua field wajib diisi.'); window.location.href='../../pages/registrasi/index.php';</script>";
        exit();
    }

    // Enkripsi password menggunakan fungsi password_hash()
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memeriksa apakah username sudah ada di database
    $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username='$username'");
    if (mysqli_num_rows($query) > 0) {
        echo "<script>alert('Username sudah digunakan.'); window.location.href='../../pages/main_layout.php?page=sign-up';</script>";
        // echo "<script>alert('Username sudah digunakan.'); window.location.href='../../pages/registrasi/index.php';</script>";
        exit();
    }

    // Query untuk menyimpan data registrasi ke database
    $query = "INSERT INTO tbl_user (fullname, email, phone, username, password) VALUES ('$fullname', '$email', '$phone', '$username', '$hashedPassword')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi berhasil. Silahkan login.'); window.location.href='../../pages/main_layout.php?page=sign-in';</script>";
        // echo "<script>alert('Registrasi berhasil. Silahkan login.'); window.location.href='../../pages/login/index.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal. Silahkan coba lagi.'); window.location.href='../../pages/main_layout.php?page=sign-up';</script>";
        // echo "<script>alert('Registrasi gagal. Silahkan coba lagi.'); window.location.href='../../pages/registrasi/index.php';</script>";
    }
}
