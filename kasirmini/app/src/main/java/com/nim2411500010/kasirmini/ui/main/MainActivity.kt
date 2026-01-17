package com.nim2411500010.kasirmini.ui.main

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import androidx.appcompat.app.AppCompatActivity
import androidx.cardview.widget.CardView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.ui.laporan.LaporanActivity
import com.nim2411500010.kasirmini.ui.produk.ProdukActivity
import com.nim2411500010.kasirmini.ui.profil.ProfilActivity
import com.nim2411500010.kasirmini.ui.transaksi.TransaksiActivity
import com.nim2411500010.kasirmini.ui.login.LoginActivity

class MainActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val cardProduk = findViewById<CardView>(R.id.cardProduk)
        val cardTransaksi = findViewById<CardView>(R.id.cardTransaksi)
        val cardLaporan = findViewById<CardView>(R.id.cardLaporan)
        val cardProfil = findViewById<CardView>(R.id.cardProfil)
        val btnLogout = findViewById<Button>(R.id.btnLogout)

        cardProduk.setOnClickListener {
            startActivity(Intent(this, ProdukActivity::class.java))
        }

        cardTransaksi.setOnClickListener {
            startActivity(Intent(this, TransaksiActivity::class.java))
        }

        cardLaporan.setOnClickListener {
            startActivity(Intent(this, LaporanActivity::class.java))
        }

        cardProfil.setOnClickListener {
            startActivity(Intent(this, ProfilActivity::class.java))
        }


        btnLogout.setOnClickListener {
            val pref = getSharedPreferences("LOGIN_SESSION", MODE_PRIVATE)
            pref.edit().clear().apply()

            val intent = Intent(this, LoginActivity::class.java)
            intent.flags = Intent.FLAG_ACTIVITY_NEW_TASK or Intent.FLAG_ACTIVITY_CLEAR_TASK
            startActivity(intent)
            finish()
        }

    }
}
