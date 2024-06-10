<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_web_reservasi_penginapan";
$conn = mysqli_connect($host, $user, $password, $dbname);

if ($conn) {
    echo "<script>console.log('berhasil koneksi ke database');</script>";
} else {
    echo "<script>console.error('gagal koneksi ke database: " . mysqli_connect_error() . "');</script>";
}
