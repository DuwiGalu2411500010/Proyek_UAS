<?php
$produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM produk"));
$transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM transaksi"));
$pendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_harga) total FROM transaksi"));
?>

<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">

<div class="col-xl-4 col-md-6 mb-4">
<div class="card bg-danger text-white shadow">
    <div class="card-body">
        <?= $produk['total'] ?>
        <div class="text-white-50 small">Total Produk</div>
    </div>
</div>
</div>


<div class="col-xl-4 col-md-6 mb-4">
<div class="card bg-info text-white shadow">
    <div class="card-body">
        <?= $transaksi['total'] ?>
        <div class="text-white-50 small">Total Transaksi</div>
    </div>
</div>
</div>

<div class="col-xl-4 col-md-6 mb-4">
<div class="card bg-success text-white shadow">
    <div class="card-body">
        Rp <?= number_format($pendapatan['total'] ?? 0) ?>
        <div class="text-white-50 small">Pendapatan</div>
    </div>
</div>
</div>
</div>
