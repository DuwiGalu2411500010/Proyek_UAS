<?php
header("Cache-Control: no-cache, must-revalidate");
require_once(__DIR__ . '/../includes/config.php');

$result = $conn->query("SELECT * FROM transaksi ORDER BY tanggal DESC");
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Transaksi</h1>

    <?php if (isset($_GET['hapus'])): ?>
        <div class="alert alert-success">
            Transaksi berhasil dihapus.
        </div>
    <?php endif; ?>

    <a href="index.php?hal=tambah_transaksi" class="btn btn-success mb-3">
        + Tambah Transaksi
    </a>

    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($t = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $t['id_transaksi'] ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($t['tanggal'])) ?></td>
                    <td>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                    <td>
                        <a href="index.php?hal=detail_transaksi&id=<?= $t['id_transaksi'] ?>"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <a href="hapus_transaksi.php?id=<?= $t['id_transaksi'] ?>"
                           onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                           class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada transaksi
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
