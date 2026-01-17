<?php
require_once(__DIR__ . '/../includes/config.php');

if (!isset($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan');history.back();</script>";
    exit;
}

$id_produk = intval($_GET['id']);

$cek = $conn->query("
    SELECT COUNT(*) AS total 
    FROM detail_transaksi 
    WHERE id_produk = $id_produk
")->fetch_assoc();

if ($cek['total'] > 0) {
    echo "<script>
        alert('Produk tidak bisa dihapus karena sudah digunakan dalam transaksi');
        window.location='index.php?hal=daftar_produk';
    </script>";
    exit;
}


$conn->query("
    DELETE FROM produk 
    WHERE id_produk = $id_produk
");

echo "<script>
    alert('Produk berhasil dihapus');
    window.location='index.php?hal=daftar_produk';
</script>";
