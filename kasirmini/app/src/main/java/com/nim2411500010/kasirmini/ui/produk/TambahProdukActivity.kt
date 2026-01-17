package com.nim2411500010.kasirmini.ui.produk

import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.ProgressBar
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.google.android.material.textfield.TextInputEditText
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.ProdukUpdateRequest
import com.nim2411500010.kasirmini.data.model.SimpleResponse
import com.nim2411500010.kasirmini.data.remote.ApiClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class TambahProdukActivity : AppCompatActivity() {

    private lateinit var etNama: TextInputEditText
    private lateinit var etHarga: TextInputEditText
    private lateinit var etStok: TextInputEditText
    private lateinit var etKategori: TextInputEditText
    private lateinit var btnSimpan: Button
    private lateinit var progress: ProgressBar

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_tambah_produk)

        etNama = findViewById(R.id.etNamaProduk)
        etHarga = findViewById(R.id.etHarga)
        etStok = findViewById(R.id.etStok)
        etKategori = findViewById(R.id.etKategori)
        btnSimpan = findViewById(R.id.btnTambahProduk)
        progress = findViewById(R.id.progressTambah)

        btnSimpan.setOnClickListener {
            simpanProduk()
        }
    }

    private fun simpanProduk() {
        val nama = etNama.text?.toString()?.trim() ?: ""
        val hargaStr = etHarga.text?.toString()?.trim() ?: ""
        val stokStr = etStok.text?.toString()?.trim() ?: ""
        val kategori = etKategori.text?.toString()?.trim() ?: ""

        if (nama.isEmpty() || hargaStr.isEmpty() || stokStr.isEmpty()) {
            Toast.makeText(this, "Semua field wajib diisi", Toast.LENGTH_SHORT).show()
            return
        }

        val harga = hargaStr.toIntOrNull()
        val stok = stokStr.toIntOrNull()

        if (harga == null || stok == null) {
            Toast.makeText(this, "Harga dan stok harus berupa angka", Toast.LENGTH_SHORT).show()
            return
        }

        progress.visibility = View.VISIBLE
        btnSimpan.isEnabled = false

        val request = ProdukUpdateRequest(
            id_produk = 0,
            nama_produk = nama,
            harga = harga,
            stok = stok,
            kategori = kategori
        )

        ApiClient.instance.tambahProduk(request)
            .enqueue(object : Callback<SimpleResponse> {

                override fun onResponse(
                    call: Call<SimpleResponse>,
                    response: Response<SimpleResponse>
                ) {
                    progress.visibility = View.GONE
                    btnSimpan.isEnabled = true

                    if (response.isSuccessful && response.body()?.success == true) {
                        Toast.makeText(
                            this@TambahProdukActivity,
                            "Produk berhasil ditambahkan",
                            Toast.LENGTH_SHORT
                        ).show()
                        finish()
                    } else {
                        Toast.makeText(
                            this@TambahProdukActivity,
                            response.body()?.message ?: "Gagal menambahkan produk",
                            Toast.LENGTH_SHORT
                        ).show()
                    }
                }

                override fun onFailure(call: Call<SimpleResponse>, t: Throwable) {
                    progress.visibility = View.GONE
                    btnSimpan.isEnabled = true
                    Toast.makeText(
                        this@TambahProdukActivity,
                        "Error: ${t.message}",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }
}
