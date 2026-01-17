package com.nim2411500010.kasirmini.data.model

data class Produk(
    val id_produk: Int,
    val nama_produk: String,
    val harga: Double,
    val stok: Int,
    val kategori: String? = null
)
