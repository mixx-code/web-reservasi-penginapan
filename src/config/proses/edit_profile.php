<?php
include '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id_user = $_POST['id_user'];

    // Persiapkan query SQL
    $sql = "UPDATE tbl_user SET fullname='$fullname', username='$username', email='$email', phone='$phone'";

    // Cek apakah password diisi atau tidak
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        // Enkripsi kata sandi sebelum menyimpannya dalam database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password='$hashed_password'";
    }

    $sql .= " WHERE id_user='$id_user'";

    // Jalankan query SQL
    if (mysqli_query($conn, $sql)) {
        // Jika query berhasil dijalankan
        echo "<script>alert('Data berhasil diedit.'); window.location.href='../../pages/main_layout.php?page=availability';</script>";
    } else {
        // Jika terjadi kesalahan
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
}
