<?php
require_once(__DIR__ . '/../includes/config.php');
include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/sidebar.php');
include(__DIR__ . '/../includes/nav.php');

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama_produk']);
    $harga = floatval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $kategori = trim($_POST['kategori']);

    if ($nama && $harga && $stok >= 0) {
        $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, stok, kategori) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdis", $nama, $harga, $stok, $kategori);

        if ($stmt->execute()) {
            $pesan = "<div class='alert alert-success'>Produk berhasil ditambahkan!</div>";
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal menambahkan produk.</div>";
        }
    } else {
        $pesan = "<div class='alert alert-warning'>Isi semua field dengan benar!</div>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Produk</h1>
    <?= $pesan ?>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" step="0.01" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php?hal=daftar_produk" class="btn btn-secondary">Kembali</a>
    </form>
</div>