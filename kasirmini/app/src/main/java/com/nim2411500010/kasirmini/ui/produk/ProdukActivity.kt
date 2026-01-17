package com.nim2411500010.kasirmini.ui.produk

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Produk
import com.nim2411500010.kasirmini.data.remote.ApiClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class ProdukActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_produk)

        val rvProduk = findViewById<RecyclerView>(R.id.rvProduk)
        rvProduk.layoutManager = LinearLayoutManager(this)

        val btnTambahProduk = findViewById<Button>(R.id.btnTambahProduk)
        btnTambahProduk.setOnClickListener {
            startActivity(
                Intent(this, TambahProdukActivity::class.java)
            )
        }

        ApiClient.instance.getProduk().enqueue(object : Callback<List<Produk>> {

            override fun onResponse(
                call: Call<List<Produk>>,
                response: Response<List<Produk>>
            ) {
                if (response.isSuccessful) {
                    rvProduk.adapter =
                        ProdukAdapter(response.body() ?: emptyList())
                } else {
                    Toast.makeText(
                        this@ProdukActivity,
                        "Gagal memuat data produk",
                        Toast.LENGTH_SHORT
                    ).show()
                }
            }

            override fun onFailure(call: Call<List<Produk>>, t: Throwable) {
                Toast.makeText(
                    this@ProdukActivity,
                    t.message,
                    Toast.LENGTH_LONG
                ).show()
            }
        })
    }
}
