<?php
header('Content-Type: application/json');
include('../includes/config.php');

if (!isset($_GET['id_transaksi'])) {
    echo json_encode([]);
    exit;
}

$id_transaksi = $_GET['id_transaksi'];

$query = "
    SELECT 
        d.id_detail,
        p.nama_produk,
        d.harga,
        d.jumlah,
        d.subtotal
    FROM detail_transaksi d
    JOIN produk p ON d.id_produk = p.id_produk
    WHERE d.id_transaksi = '$id_transaksi'
";

$result = mysqli_query($conn, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
