<?php
require_once(__DIR__ . '/../includes/config.php');

$dari = $_GET['dari'] ?? date('Y-m-01');
$sampai = $_GET['sampai'] ?? date('Y-m-d');

$sql = "
    SELECT 
        t.id_transaksi,
        t.tanggal,
        t.total_harga,
        t.kasir
    FROM transaksi t
    WHERE DATE(t.tanggal) BETWEEN '$dari' AND '$sampai'
    ORDER BY t.tanggal DESC
";
$result = $conn->query($sql);

$totalPendapatan = 0;
$totalTransaksi  = $result ? $result->num_rows : 0;
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Laporan Penjualan</h1>

    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            Filter Laporan
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3">
                <input type="hidden" name="hal" value="laporan_penjualan">

                <div class="col-md-4">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="<?= $dari ?>">
                </div>

                <div class="col-md-4">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="<?= $sampai ?>">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary">
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Total Transaksi</h6>
                    <h3><?= $totalTransaksi ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Pendapatan</h6>
                    <?php
                    if ($result) {
                        mysqli_data_seek($result, 0);
                        while ($r = $result->fetch_assoc()) {
                            $totalPendapatan += $r['total_harga'];
                        }
                        mysqli_data_seek($result, 0);
                    }
                    ?>
                    <h3>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            Data Penjualan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while($t = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $t['id_transaksi'] ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($t['tanggal'])) ?></td>
                        <td><?= $t['kasir'] ?></td>
                        <td>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                        <td>
                            <a href="index.php?hal=detail_transaksi&id=<?= $t['id_transaksi'] ?>"
                               class="btn btn-info btn-sm">
                               Detail
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
