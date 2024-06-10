<?php
// Panggil file koneksi ke database
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap dan sanitasi data dari form login
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi bahwa semua field wajib diisi
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan password wajib diisi.');</script>";
        echo "<meta http-equiv='refresh' content='0; url= ../../pages/main_layout.php?page=sign-in'>";
        exit();
    }

    // Query untuk memeriksa username dan mengambil password hash
    $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username='$username'");
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['isLogin'] = true;

            // Redirect ke halaman dashboard atau halaman yang diinginkan
            echo "<meta http-equiv='refresh' content='0; url= ../../pages/main_layout.php?page=availability'>";
            exit();
        } else {
            // Password salah
            echo "<script>alert('Password salah.');</script>";
            echo "<meta http-equiv='refresh' content='0; url= ../../pages/main_layout.php?page=sign-in'>";
            exit();
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak ditemukan.');</script>";
        echo "<meta http-equiv='refresh' content='0; url= ../../pages/main_layout.php?page=sign-in'>";
        exit();
    }
}
