package com.nim2411500010.kasirmini.ui.transaksi

import android.os.Bundle
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.DetailTransaksi
import com.nim2411500010.kasirmini.data.remote.ApiClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class DetailTransaksiActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_detail_transaksi)

        val rv = findViewById<RecyclerView>(R.id.rvDetailTransaksi)
        val tvTotal = findViewById<TextView>(R.id.tvTotal)

        val idTransaksi = intent.getIntExtra("id_transaksi", -1)
        if (idTransaksi == -1) {
            Toast.makeText(this, "ID Transaksi tidak valid", Toast.LENGTH_SHORT).show()
            finish()
            return
        }

        rv.layoutManager = LinearLayoutManager(this)

        ApiClient.instance.GetDetailTransaksi(idTransaksi)
            .enqueue(object : Callback<List<DetailTransaksi>> {

                override fun onResponse(
                    call: Call<List<DetailTransaksi>>,
                    response: Response<List<DetailTransaksi>>
                ) {
                    if (response.isSuccessful) {
                        val data = response.body() ?: emptyList()
                        rv.adapter = DetailTransaksiAdapter(data)

                        val total = data.sumOf { it.subtotal }
                        tvTotal.text = "Total: Rp ${total.toInt()}"
                    } else {
                        Toast.makeText(
                            this@DetailTransaksiActivity,
                            "Gagal memuat detail",
                            Toast.LENGTH_SHORT
                        ).show()
                    }
                }

                override fun onFailure(call: Call<List<DetailTransaksi>>, t: Throwable) {
                    Toast.makeText(
                        this@DetailTransaksiActivity,
                        t.message,
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }
}
