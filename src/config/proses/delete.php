<?php
include_once "../koneksi.php"; // file koneksi ke database

// cek apakah parameter transaction_kode ada
if (isset($_GET['transaction_kode'])) {
    // ambil nilai transaction_kode langsung dari parameter GET
    $transaction_kode = $_GET['transaction_kode'];
    // query untuk menghapus data transaksi berdasarkan transaction_kode
    $sql = "DELETE FROM tbl_transactions WHERE transaction_kode = '$transaction_kode'";

    // menjalankan query
    if (mysqli_query($conn, $sql)) {
        // jika berhasil menghapus, redirect ke halaman utama
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='../../pages/main_layout.php?page=transactions';</script>";
        exit();
    } else {
        // jika gagal, tampilkan pesan error
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// menutup koneksi
mysqli_close($conn);
