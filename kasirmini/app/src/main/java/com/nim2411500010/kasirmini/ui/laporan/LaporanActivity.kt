package com.nim2411500010.kasirmini.ui.laporan

import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.widget.Button
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Laporan
import com.nim2411500010.kasirmini.data.remote.ApiClient
import com.nim2411500010.kasirmini.ui.transaksi.DetailTransaksiActivity
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LaporanActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_laporan)

        val rvLaporan = findViewById<RecyclerView>(R.id.rvLaporan)
        val btnPrint = findViewById<Button>(R.id.btnPrint)

        rvLaporan.layoutManager = LinearLayoutManager(this)

        ApiClient.instance.getLaporan().enqueue(object :
            Callback<List<Laporan>> {

            override fun onResponse(
                call: Call<List<Laporan>>,
                response: Response<List<Laporan>>
            ) {
                if (response.isSuccessful) {
                    val data = response.body() ?: emptyList()
                    rvLaporan.adapter = LaporanAdapter(data) { laporan ->
                        val intent = Intent(
                            this@LaporanActivity,
                            DetailTransaksiActivity::class.java
                        )
                        intent.putExtra("id_transaksi", laporan.id_transaksi)
                        startActivity(intent)
                    }
                } else {
                    Toast.makeText(
                        this@LaporanActivity,
                        "Gagal memuat laporan",
                        Toast.LENGTH_SHORT
                    ).show()
                }
            }

            override fun onFailure(call: Call<List<Laporan>>, t: Throwable) {
                Toast.makeText(
                    this@LaporanActivity,
                    "Error: ${t.message}",
                    Toast.LENGTH_LONG
                ).show()
            }
        })

        btnPrint.setOnClickListener {
            val url = "http://YOUR_SERVER/api/laporan_print.php"
            val intent = Intent(Intent.ACTION_VIEW)
            intent.data = Uri.parse(url)
            startActivity(intent)
        }
    }
}
