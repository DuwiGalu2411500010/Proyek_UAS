<?php
require_once(__DIR__ . '/../includes/config.php');
include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/sidebar.php');
include(__DIR__ . '/../includes/nav.php');

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-4'>ID transaksi tidak ditemukan.</div>";
    exit;
}

$id_transaksi = intval($_GET['id']);

$qTransaksi = $conn->query("
    SELECT * 
    FROM transaksi 
    WHERE id_transaksi = $id_transaksi
");
$transaksi = $qTransaksi->fetch_assoc();

if (!$transaksi) {
    echo "<div class='alert alert-danger m-4'>Transaksi tidak ditemukan.</div>";
    exit;
}

$qDetail = $conn->query("
    SELECT 
        dt.id_detail,
        p.nama_produk,
        dt.jumlah,
        dt.subtotal
    FROM detail_transaksi dt
    JOIN produk p ON dt.id_produk = p.id_produk
    WHERE dt.id_transaksi = $id_transaksi
");
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Transaksi</h1>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <strong>Informasi Transaksi</strong>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">ID Transaksi</th>
                    <td>: <?= $transaksi['id_transaksi'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>: <?= date('d-m-Y H:i', strtotime($transaksi['tanggal'])) ?></td>
                </tr>
                <tr>
                    <th>Kasir</th>
                    <td>: <?= $transaksi['kasir'] ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>: <strong>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></strong></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>Daftar Barang yang Dibeli</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total = 0;
                    while ($d = $qDetail->fetch_assoc()):
                        $total += $d['subtotal'];
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_produk'] ?></td>
                        <td><?= $d['jumlah'] ?></td>
                        <td>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="index.php?hal=daftar_transaksi" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Transaksi
        </a>
        <button onclick="window.print()" class="btn btn-success">
            <i class="fas fa-print"></i> Cetak Struk
        </button>
    </div>
</div>