<?php
// Query SQL
$sql = "SELECT 
    MIN(tbl_transactions.id_room) AS id_room,
    tbl_transactions.id_user,
    MIN(tbl_transactions.transaction_date) AS transaction_date,
    SUM(tbl_transactions.price) AS total_price,
    MIN(tbl_transactions.start_date) AS start_date,
    MIN(tbl_transactions.end_date) AS end_date,
    tbl_transactions.transaction_kode,
    MIN(tbl_rooms.type_rooms) AS type_rooms,
    COUNT(tbl_transactions.transaction_kode) AS total_transaction_kode
FROM 
    tbl_transactions
JOIN
    tbl_rooms ON tbl_transactions.id_room = tbl_rooms.id_room
WHERE
    tbl_transactions.id_user = $id_user
GROUP BY 
    tbl_transactions.transaction_kode, tbl_transactions.id_user
";

// Eksekusi query
$result = $conn->query($sql);
?>
<h1 style="width: 100%; text-align: center;">transaction list</h1>
<div class="container-transaction">
    <?php
    // Ambil hasil query dan tampilkan dalam tabel
    if ($result->num_rows > 0) {
        // Menampilkan data untuk setiap baris
        while ($row = $result->fetch_assoc()) {
    ?>
            <div class="card-trans">
                <div class="img-card-trans">
                    <img src="../../asset/img/kasur.png" alt="">
                </div>
                <div class="content-card-trans">
                    <h1 class="title-card-trans"><?= htmlspecialchars($row["type_rooms"], ENT_QUOTES) ?> . . . </h1>
                    <p>Jumlah item : <?= htmlspecialchars($row["total_transaction_kode"], ENT_QUOTES) ?>x </p>
                    <p>Transaction date : <?= htmlspecialchars($row["transaction_date"], ENT_QUOTES) ?></p>
                    <br>
                    <p>Total price</p>
                    <h2>Rp. <?= number_format($row["total_price"], 2, ',', '.') ?></h2>
                    <p style="text-decoration: underline; font-style: italic; color: #686D76; font-size: small;">Kode transaction : <?= htmlspecialchars($row["transaction_kode"], ENT_QUOTES) ?> </p>
                </div>
                <div style="height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 10px;">
                    <a href="../pages/main_layout.php?page=detail-transaction&transaction_kode=<?= $row["transaction_kode"]; ?>"" class=" btn-card-trans" onclick="return confirmSignIn()">detail</a>
                    <a href="../config/proses/delete.php?transaction_kode=<?= $row["transaction_kode"]; ?>" class="btn-del-card-trans" onclick="return confirmSignIn()">delete</a>
                </div>
            </div>
    <?php
        }
    }

    ?>
</div>