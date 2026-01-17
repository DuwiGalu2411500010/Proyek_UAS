package com.nim2411500010.kasirmini.data.model

data class DetailTransaksi(
    val id_detail: Int,
    val nama_produk: String,
    val harga: Double,
    val jumlah: Int,
    val subtotal: Double
)

