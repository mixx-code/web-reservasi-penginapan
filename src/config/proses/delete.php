<?php
include_once "../db/koneksi.php"; // file koneksi ke database

// cek apakah parameter id ada
if (isset($_GET['transaction_code'])) {
    $transaction_kode = $_GET['transaction_kode'];

    // query untuk menghapus data puisi berdasarkan id
    $sql = "DELETE FROM tbl_transaction WHERE transaction_kode = $transaction_kode";

    // menjalankan query
    if (mysqli_query($conn, $sql)) {
        // jika berhasil menghapus, redirect ke halaman utama
        echo "<script>alert('Data berhasil disimpan.'); window.location.href='../../pages/main_layout.php?page=transactions';</script>";
        exit();
    } else {
        // jika gagal, tampilkan pesan error
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// tutup koneksi
mysqli_close($conn);
