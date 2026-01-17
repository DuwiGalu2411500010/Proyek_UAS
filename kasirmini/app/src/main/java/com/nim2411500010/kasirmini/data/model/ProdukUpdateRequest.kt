package com.nim2411500010.kasirmini.data.model

data class ProdukUpdateRequest(
    val id_produk: Int,
    val nama_produk: String,
    val harga: Int,
    val stok: Int,
    val kategori: String
)
