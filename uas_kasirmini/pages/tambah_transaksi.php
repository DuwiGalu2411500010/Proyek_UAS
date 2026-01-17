<?php
require_once(__DIR__ . '/../includes/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/sidebar.php');
include(__DIR__ . '/../includes/nav.php');

$pesan = "";


$produkList = $conn->query("SELECT * FROM produk WHERE stok > 0 ORDER BY nama_produk ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tanggal = date('Y-m-d H:i:s');
    $produk  = $_POST['produk'] ?? [];
    $jumlah  = $_POST['jumlah'] ?? [];

    if (!empty($produk) && !empty($jumlah)) {

        $total = 0;
        foreach ($produk as $i => $idp) {
            $q = $conn->query("SELECT harga FROM produk WHERE id_produk = $idp");
            $row = $q->fetch_assoc();
            $subtotal = $row['harga'] * intval($jumlah[$i]);
            $total += $subtotal;
        }

        $kasir = $_SESSION['admin']['nama_lengkap'] ?? 'Admin';

        $stmt = $conn->prepare(
            "INSERT INTO transaksi (tanggal, total_harga, kasir) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sds", $tanggal, $total, $kasir);
        $stmt->execute();

        $id_transaksi = $conn->insert_id;

        foreach ($produk as $i => $idp) {

            $jumlah_beli = intval($jumlah[$i]);

            $q = $conn->query("SELECT harga FROM produk WHERE id_produk = $idp");
            $row = $q->fetch_assoc();
            $harga = $row['harga'];

            $subtotal = $harga * $jumlah_beli;

            $conn->query("
                INSERT INTO detail_transaksi 
                (id_transaksi, id_produk, jumlah, subtotal)
                VALUES 
                ($id_transaksi, $idp, $jumlah_beli, $subtotal)
            ");

            $conn->query("
                UPDATE produk 
                SET stok = stok - $jumlah_beli 
                WHERE id_produk = $idp
            ");
        }

        $pesan = "<div class='alert alert-success'>Transaksi berhasil disimpan!</div>";

    } else {
        $pesan = "<div class='alert alert-warning'>Pilih produk dan masukkan jumlah!</div>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Transaksi</h1>
    <?= $pesan ?>

    <form method="POST">
        <div id="produk-container">

            <div class="row mb-3 produk-row">
                <div class="col-md-6">
                    <label>Produk</label>
                    <select name="produk[]" class="form-select" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php
                        $produkList->data_seek(0);
                        while ($p = $produkList->fetch_assoc()):
                        ?>
                            <option value="<?= $p['id_produk'] ?>">
                                <?= $p['nama_produk'] ?> - Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control" min="1" required>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                </div>
            </div>

        </div>

        <button type="button" id="add-row" class="btn btn-secondary mb-3">
            + Tambah Produk
        </button>
        <br>

        <button type="submit" class="btn btn-success">
            Simpan Transaksi
        </button>
        <a href="index.php?hal=daftar_transaksi" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>

<script>
document.getElementById('add-row').addEventListener('click', function () {
    const container = document.getElementById('produk-container');
    const row = document.querySelector('.produk-row').cloneNode(true);

    row.querySelector('select').value = '';
    row.querySelector('input').value = '';

    container.appendChild(row);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        const rows = document.querySelectorAll('.produk-row');
        if (rows.length > 1) {
            e.target.closest('.produk-row').remove();
        }
    }
});
</script>