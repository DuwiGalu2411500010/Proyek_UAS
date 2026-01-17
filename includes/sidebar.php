<?php
if (!isset($page)) {
    $page = '';
}
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Core</div>
<a class="nav-link <?= ($page == "dashboard") ? 'active' : ''; ?>"
   href="index.php?hal=dashboard">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<div class="sb-sidenav-menu-heading">Manejemen Data</div>
<a class="nav-link <?= ($page == "daftar_produk") ? 'active' : ''; ?>"
   href="index.php?hal=daftar_produk">
   <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
    Produk
</a>


<a class="nav-link <?= ($page == "daftar_transaksi") ? 'active' : ''; ?>"
   href="index.php?hal=daftar_transaksi">
     <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
    Transaksi
</a>


<div class="sb-sidenav-menu-heading">Laporan</div>
<li class="nav-item">
    <a class="nav-link" href="index.php?hal=laporan_penjualan">
        <i class="fas fa-file-alt"></i>
        Laporan Penjualan
    </a>
</li>

<a class="nav-link" href="logout.php">
    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
    Logout
</a>


            </div>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small">Login sebagai:</div>
            <?= $_SESSION['username'] ?? 'Admin'; ?>
        </div>
    </nav>
</div>