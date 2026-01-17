<?php
header('Content-Type: application/json');
include('../includes/config.php');

$query = "SELECT id_transaksi, tanggal, total_harga, kasir 
          FROM transaksi 
          ORDER BY tanggal DESC";

$result = mysqli_query($conn, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
