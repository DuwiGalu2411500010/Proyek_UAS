<?php
header('Content-Type: application/json');
require_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Method tidak diizinkan'
    ]);
    exit;
}

$total_harga = $_POST['total_harga'] ?? 0;
$kasir = $_POST['kasir'] ?? '';
$id_produk = $_POST['id_produk'] ?? 0;
$jumlah = $_POST['jumlah'] ?? 0;
$harga = $_POST['harga'] ?? 0;

$tanggal = date('Y-m-d H:i:s');

$queryTransaksi = "INSERT INTO transaksi (tanggal, total_harga, kasir)
                   VALUES ('$tanggal', '$total_harga', '$kasir')";

if (!mysqli_query($conn, $queryTransaksi)) {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal simpan transaksi'
    ]);
    exit;
}

$id_transaksi = mysqli_insert_id($conn);
$subtotal = $harga * $jumlah;

$queryDetail = "INSERT INTO detail_transaksi (id_transaksi, id_produk, harga, jumlah, subtotal)
                VALUES ('$id_transaksi', '$id_produk', '$harga', '$jumlah', '$subtotal')";

if (!mysqli_query($conn, $queryDetail)) {
    echo json_encode([
        'success' => false,
        'message' => 'Detail transaksi gagal'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Transaksi berhasil',
    'id_transaksi' => $id_transaksi
]);
