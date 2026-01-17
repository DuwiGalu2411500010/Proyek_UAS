package com.nim2411500010.kasirmini.ui.transaksi

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Transaksi

class TransaksiActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_transaksi)

        val rvTransaksi = findViewById<RecyclerView>(R.id.rvTransaksi)
        val txtTotalPendapatan = findViewById<TextView>(R.id.txtTotalPendapatan)
        val btnTambah = findViewById<Button>(R.id.btnTambahTransaksi)

        val transaksiList = listOf(
            Transaksi(1, "2026-01-15", 12000.0),
            Transaksi(2, "2026-01-16", 18000.0),
            Transaksi(3, "2026-01-17", 25000.0)
        )


        val totalPendapatan = transaksiList.sumOf { it.total_harga }
        txtTotalPendapatan.text = "Total Pendapatan: Rp $totalPendapatan"

        rvTransaksi.layoutManager = LinearLayoutManager(this)
        rvTransaksi.adapter = TransaksiAdapter(transaksiList)

        btnTambah.setOnClickListener {
            val intent = Intent(this, TambahTransaksiActivity::class.java)
            startActivity(intent)
        }

    }
}
