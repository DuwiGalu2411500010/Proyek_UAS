<?php
require_once(__DIR__ . '/../includes/config.php');
include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/sidebar.php');
include(__DIR__ . '/../includes/nav.php');

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-4'>ID produk tidak ditemukan.</div>";
    include(__DIR__ . '/../includes/footer.php');
    exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM produk WHERE id_produk = $id");
$produk = $result->fetch_assoc();

if (!$produk) {
    echo "<div class='alert alert-danger m-4'>Produk tidak ditemukan.</div>";
    include(__DIR__ . '/../includes/footer.php');
    exit;
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama_produk']);
    $harga = floatval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $kategori = trim($_POST['kategori']);

    $stmt = $conn->prepare("UPDATE produk SET nama_produk=?, harga=?, stok=?, kategori=? WHERE id_produk=?");
    $stmt->bind_param("sdisi", $nama, $harga, $stok, $kategori, $id);

    if ($stmt->execute()) {
        $pesan = "<div class='alert alert-success'>Produk berhasil diperbarui!</div>";
        $produk = ['nama_produk'=>$nama, 'harga'=>$harga, 'stok'=>$stok, 'kategori'=>$kategori];
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal memperbarui produk.</div>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Ubah Produk</h1>
    <?= $pesan ?>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" step="0.01" name="harga" value="<?= $produk['harga'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $produk['stok'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= htmlspecialchars($produk['kategori']) ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        <a href="index.php?hal=daftar_produk" class="btn btn-secondary">Kembali</a>
    </form>
</div>

