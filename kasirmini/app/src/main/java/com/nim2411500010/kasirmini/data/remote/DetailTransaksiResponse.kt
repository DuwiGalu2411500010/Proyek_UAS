package com.nim2411500010.kasirmini.data.remote

data class DetailTransaksiResponse(
    val id_detail: Int,
    val id_transaksi: Int,
    val id_produk: Int,
    val jumlah: Int,
    val harga: Double
)
