<?php
include '../components/hero.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        // Menginisialisasi array session jika belum ada
        if (!isset($_SESSION['selected_rooms'])) {
            $_SESSION['selected_rooms'] = [];
        }

        // Menambahkan kamar yang dipilih ke dalam session
        $_SESSION['selected_rooms'][] = [
            'id_room' => $_POST['id_room'],
            'id_user' => $_POST['id_user'],
            'transaction_date' => $_POST['transaction_date'],
            'type_rooms' => $_POST['type_rooms'],
            'price' => $_POST['price']
        ];

        // Redirect untuk mencegah form resubmission
        header("Location: #content");
        // header("Location: ./main_layout.php?page=availability");
        exit();
    } elseif ($_POST['action'] == 'delete') {
        // Menghapus kamar dari session
        if (isset($_SESSION['selected_rooms'])) {
            foreach ($_SESSION['selected_rooms'] as $key => $room) {
                if ($room['id_room'] == $_POST['id_room']) {
                    unset($_SESSION['selected_rooms'][$key]);
                    break;
                }
            }

            // Mengatur ulang indeks array untuk menghindari masalah dengan tampilan
            $_SESSION['selected_rooms'] = array_values($_SESSION['selected_rooms']);
        }

        // Redirect untuk mencegah form resubmission
        header("Location: #content");
        // header("Location: ./main_layout.php?page=availability");
        exit();
    }
}


// Fungsi untuk menghitung total harga dari data yang disimpan di dalam session
function calculateTotalPrice($selectedRooms)
{
    $totalPrice = 0;
    foreach ($selectedRooms as $room) {
        $totalPrice += $room['price'];
    }
    return $totalPrice;
}
?>

<div id="content">
    <div class="list-card">
        <?php

        $sql = "SELECT id_room, type_rooms, desk_room, price FROM TBL_rooms";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Menampilkan data untuk setiap baris
            while ($row = $result->fetch_assoc()) {
                echo '
        <div class="card">
            <div class="img-card">
                <img src="../../asset/img/kasur.png" alt="">
            </div>
            <div class="content-card">
                <h1 class="title-card">' . htmlspecialchars($row["type_rooms"], ENT_QUOTES) . '</h1>
                <p class="desk-card">' . htmlspecialchars(mb_strimwidth($row["desk_room"], 0, 150, "..."), ENT_QUOTES) . '</p>
                <div class="container-action-card">
                    <p class="uang-card">Rp. ' . number_format($row["price"], 2, ',', '.') . '</p>
                    <form method="post" action="">';

                // Hanya tampilkan input id_user jika $id_user tersedia
                if (isset($id_user) && $id_user !== '') {
                    echo '<input type="hidden" name="id_user" value="' . htmlspecialchars($id_user, ENT_QUOTES) . '">';
                }

                echo '<input type="hidden" name="id_room" value="' . htmlspecialchars($row["id_room"], ENT_QUOTES) . '">
            <input type="hidden" name="type_rooms" value="' . htmlspecialchars($row["type_rooms"], ENT_QUOTES) . '">
            <input type="hidden" name="price" value="' . htmlspecialchars($row["price"], ENT_QUOTES) . '">
            <input type="hidden" name="transaction_date" value="' . date('Y-m-d') . '">
            <input type="hidden" name="action" value="add">';

                // Tampilkan tombol "Select" atau tautan "Sign-in" tergantung pada ketersediaan $id_user
                if (isset($id_user) && $id_user !== '') {
                    echo '<button type="submit" class="btn-card">Select</button>';
                } else {
                    echo '<a href="../pages/main_layout.php?page=sign-in" class="btn-card-sign" onclick="return confirmSignIn()">Select</a>';
                }

                echo '
                    </form>
                </div>
            </div>
        </div>';
            }
        } else {
            echo "0 results";
        }

        // Menutup koneksi
        $conn->close();
        ?>
    </div>
    <div class="container-invoice">
        <div class="card-invoice">
            <form action="" method="post" class="form-card">
                <div class="list-invoice-kamar">
                    <?php
                    if (isset($_SESSION['selected_rooms']) && count($_SESSION['selected_rooms']) > 0) {
                        echo "<script>console.log(" . json_encode($_SESSION['selected_rooms']) . ");</script>";
                        foreach ($_SESSION['selected_rooms'] as $room) {
                            echo '
                                <div class="wrapper-input-invoice">
                                    <input type="text" class="input-invoice" value="' . htmlspecialchars($room["type_rooms"], ENT_QUOTES) . '" disabled>
                                    <input type="text" class="input-invoice" value="Rp. ' . number_format($room["price"], 2, ',', '.') . '" disabled>
                                    <input type="hidden" name="id_room" value="' . htmlspecialchars($room["id_room"], ENT_QUOTES) . '">
                                    <input type="hidden" name="transaction_date" value="' . htmlspecialchars($room["transaction_date"], ENT_QUOTES) . '">
                                    <input type="hidden" name="id_user" value="' . htmlspecialchars($room["id_user"], ENT_QUOTES) . '">
                                    <input type="hidden" name="action" value="delete">
                                    <a class="btn-delete" href="#content" onclick="this.closest(\'form\').submit(); return false;">x</a>
                                </div>';
                        }
                    } else {
                        echo '<img src="../../asset/img/empty.png" alt="empty" style="width: 155px;" >';
                        echo '<p>Belum ada kamar yang dipilih</p>';
                    }
                    ?>
                </div>
            </form>
            <form action="../config/proses/insert.php" method="post" style="width: 100%; display: flex; align-items: center;">
                <?php if (isset($_SESSION['selected_rooms']) && count($_SESSION['selected_rooms']) > 0) { ?>
                    <div class="wrapper-card-date">
                        <div>
                            <p>Start Date</p>
                            <input type="date" class="input-date" name="start_date" required>
                        </div>
                        <div>
                            <p>End Date</p>
                            <input type="date" class="input-date" name="end_date" required>
                        </div>
                    </div>
                <?php } ?>

                <?php
                if (isset($_SESSION['selected_rooms']) && count($_SESSION['selected_rooms']) > 0) {
                    echo "<script>console.log(" . json_encode($_SESSION['selected_rooms']) . ");</script>";
                    foreach ($_SESSION['selected_rooms'] as $room) {
                        echo '
                                <div style="display: none;">
                                    <input required type="hidden" class="input-invoice" value="' . htmlspecialchars($room["type_rooms"], ENT_QUOTES) . '" disabled>
                                    <input required type="hidden" class="input-invoice" value="Rp. ' . number_format($room["price"], 2, ',', '.') . '" disabled>
                                    <input required type="hidden" name="id_room" value="' . htmlspecialchars($room["id_room"], ENT_QUOTES) . '">
                                    <input required type="hidden" name="transaction_date" value="' . htmlspecialchars($room["transaction_date"], ENT_QUOTES) . '">
                                    <input required type="hidden" name="id_user" value="' . htmlspecialchars($room["id_user"], ENT_QUOTES) . '">
                                </div>';
                    }
                } else {
                    echo '';
                }
                ?>
                <?php if (isset($_SESSION['selected_rooms']) && count($_SESSION['selected_rooms']) > 0) { ?>
                    <div class="total-harga">
                        <h1>Harga Total</h1>
                        <p>Rp. <?php echo number_format(calculateTotalPrice($_SESSION['selected_rooms']), 2, ',', '.'); ?></p>
                    </div>
                    <!-- <button type="submit" name="submit" class="btn-book">Book</button> -->
                    <button type="submit" name="submit" class="btn-book">Book</button>
                <?php } ?>
            </form>
        </div>
        <a href="../pages/main_layout.php?page=transactions" class="btn-trans">view transactions</a>
    </div>
</div>


<script>
    function confirmSignIn() {
        return alert("Anda belum login. Apakah Anda ingin login sekarang?");
    }
</script>