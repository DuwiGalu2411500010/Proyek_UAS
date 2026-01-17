<?php
require_once(__DIR__ . '/../includes/config.php');
include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/sidebar.php');
include(__DIR__ . '/../includes/nav.php');

$result = $conn->query("SELECT * FROM produk ORDER BY nama_produk ASC");
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Produk</h1>
    <a href="index.php?hal=tambah_produk" class="btn btn-success mb-3">+ Tambah Produk</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($p = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $p['id_produk'] ?></td>
                    <td><?= $p['nama_produk'] ?></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                    <td><?= $p['stok'] ?></td>
                    <td><?= $p['kategori'] ?></td>
                    <td>
                        <a href="index.php?hal=ubah_produk&id=<?= $p['id_produk'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?hal=hapus_produk&id=<?= $p['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Belum ada produk</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>



