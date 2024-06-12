<?php
$kode = $_GET['transaction_kode'];

// Sanitize the input to prevent SQL injection
$kode = intval($kode);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT t.id_transaction, t.id_room, t.id_user, t.transaction_date, t.price AS transaction_price, t.start_date, t.end_date, t.transaction_kode, r.type_rooms, r.desk_room, r.price AS room_price,
        (SELECT SUM(t1.price) FROM tbl_transactions t1 WHERE t1.transaction_kode = t.transaction_kode) AS total_price 
        FROM tbl_transactions t 
        JOIN tbl_rooms r ON t.id_room = r.id_room 
        WHERE t.transaction_kode = $kode";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$rows = [];
$total_price = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
    $total_price = $row['total_price'];
}

$conn->close();
?>

<div style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div style="border: 2px solid #B19753; width: 70%; height: auto; box-sizing: border-box; padding: 20px; border-radius: 15px;">
        <h1 style="font-size: 20px; font-weight: 700; text-transform: capitalize;">Detail Transaction</h1>
        <h1 style="font-size: 16px; font-weight: 700; text-transform: capitalize;">Kode: <span style="font-style: italic; font-weight: 400; text-decoration: underline; color: #B19753;"><?= htmlspecialchars($kode) ?></span></h1>

        <div>
            <h1 style="font-size: 16px; font-weight: 700; text-transform: capitalize; padding: 20px 0px;">Detail Transaction</h1>
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="text-align: left;">
                    <tr>
                        <th style="padding: 10px; width: 5%;">No</th>
                        <th style="padding: 10px; width: 15%;">Room</th>
                        <th style="padding: 10px; width: 35%;">Desc Room</th>
                        <th style="padding: 10px;">Start Date</th>
                        <th style="padding: 10px;">End Date</th>
                        <th style="padding: 10px;">Transaction Date</th>
                        <th style="padding: 10px;">Price</th>
                    </tr>
                </thead>
                <tbody style="text-align: left;">
                    <?php
                    $index = 1;
                    foreach ($rows as $row) : ?>
                        <tr>
                            <td style="padding: 10px;"><?= $index++ ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['type_rooms']) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['desk_room']) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['start_date']) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['end_date']) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['transaction_date']) ?></td>
                            <td style="padding: 10px;">Rp. <?= number_format($row["transaction_price"], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="padding: 10px; font-weight: 700; text-align: center;" colspan="6">Total harga</td>
                        <td style="padding: 10px; font-weight: 700;">Rp. <?= number_format($total_price, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>