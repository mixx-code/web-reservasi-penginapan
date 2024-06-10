<?php
include "../koneksi.php";


function getCurrentTimestamp()
{
    // Mendapatkan timestamp saat ini
    return time();
}

// Contoh penggunaan
$currentTimestamp = getCurrentTimestamp();
// echo "Timestamp saat ini: " . $currentTimestamp;


// Pastikan bahwa form disubmit dan aksi adalah untuk "book"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);

    // Pastikan ada kamar yang dipilih sebelum menyimpan ke database
    if (isset($_SESSION['selected_rooms']) && count($_SESSION['selected_rooms']) > 0) {

        // Loop melalui data kamar yang dipilih dan simpan ke database
        foreach ($_SESSION['selected_rooms'] as $room) {
            $id_room = $room['id_room'];
            $id_user = $_SESSION['id_user']; // Pastikan id_user diambil dari session
            $transaction_date = date('Y-m-d'); // Gunakan tanggal hari ini
            $price = $room['price'];

            // Query SQL untuk menyimpan data ke dalam tabel
            $query = "INSERT INTO tbl_transactions (id_room, id_user, transaction_date, price, start_date, end_date, transaction_kode) VALUES ('$id_room', '$id_user', '$transaction_date', '$price', '$start_date', '$end_date', '$currentTimestamp')";

            // menjalankan query
            $result = mysqli_query($conn, $query);

            // mengecek apakah query berhasil dijalankan atau tidak
            if (!$result) {
                // tampilkan pesan error jika query gagal dijalankan
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }


        // Hapus data session selected_rooms
        unset($_SESSION['selected_rooms']);
        // Setelah berhasil menyimpan data, tambahkan alert
        // echo "<script>alert('Data berhasil disimpan.');</script>";
    } else {
        echo "Tidak ada kamar yang dipilih.";
    }

    // menutup koneksi ke database
    mysqli_close($conn);

    // Redirect ke halaman utama
    echo "<script>alert('Data berhasil disimpan.'); window.location.href='../../pages/main_layout.php?page=availability';</script>";
    exit();
}
