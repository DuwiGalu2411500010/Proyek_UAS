package com.nim2411500010.kasirmini.data.remote

import com.nim2411500010.kasirmini.data.model.*
import retrofit2.Call
import retrofit2.http.*

interface ApiService {

    @FormUrlEncoded
    @POST("login.php")
    fun login(
        @Field("username") username: String,
        @Field("password") password: String
    ): Call<LoginResponse>

    @GET("produk.php")
    fun getProduk(): Call<List<Produk>>

    @POST("produk.php")
    fun tambahProduk(
        @Body request: ProdukUpdateRequest
    ): Call<SimpleResponse>

    @PUT("produk.php")
    fun updateProduk(
        @Body request: ProdukUpdateRequest
    ): Call<SimpleResponse>

    @DELETE("produk.php")
    fun hapusProduk(
        @Query("id_produk") idProduk: Int
    ): Call<SimpleResponse>

    @FormUrlEncoded
    @POST("transaksi.php")
    fun tambahTransaksi(
        @Field("total_harga") totalHarga: Double,
        @Field("kasir") kasir: String
    ): Call<TransaksiResponse>

    @FormUrlEncoded
    @POST("detail_transaksi.php")
    fun TambahDetailTransaksi(
        @Field("id_transaksi") idTransaksi: Int,
        @Field("id_produk") idProduk: Int,
        @Field("harga") harga: Double,
        @Field("jumlah") jumlah: Int
    ): Call<SimpleResponse>

    @GET("laporan.php")
    fun getLaporan(): Call<List<Laporan>>

    @GET("detail_transaksi.php")
    fun GetDetailTransaksi(
        @Query("id_transaksi") idTransaksi: Int
    ): Call<List<DetailTransaksi>>
}
