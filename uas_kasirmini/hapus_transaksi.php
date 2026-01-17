<?php
session_start();
require_once "includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: index.php?hal=daftar_transaksi");
    exit;
}

$id = intval($_GET['id']);

$conn->query("DELETE FROM detail_transaksi WHERE id_transaksi = $id");

$conn->query("DELETE FROM transaksi WHERE id_transaksi = $id");

header("Location: index.php?hal=daftar_transaksi&msg=hapus");
exit;

