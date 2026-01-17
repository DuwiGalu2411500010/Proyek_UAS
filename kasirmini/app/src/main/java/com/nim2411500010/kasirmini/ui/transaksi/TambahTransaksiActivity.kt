package com.nim2411500010.kasirmini.ui.transaksi

import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Produk
import com.nim2411500010.kasirmini.data.model.SimpleResponse
import com.nim2411500010.kasirmini.data.remote.ApiClient
import com.nim2411500010.kasirmini.data.remote.TransaksiResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class TambahTransaksiActivity : AppCompatActivity() {

    private lateinit var spinnerProduk: Spinner
    private lateinit var inputJumlah: EditText
    private lateinit var txtTotal: TextView
    private lateinit var btnSimpan: Button
    private lateinit var btnKembali: Button

    private var daftarProduk: List<Produk> = emptyList()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_tambah_transaksi)

        spinnerProduk = findViewById(R.id.spinnerProduk)
        inputJumlah = findViewById(R.id.inputJumlah)
        txtTotal = findViewById(R.id.txtTotal)
        btnSimpan = findViewById(R.id.btnSimpan)
        btnKembali = findViewById(R.id.btnKembali)

        loadProduk()

        spinnerProduk.onItemSelectedListener =
            object : AdapterView.OnItemSelectedListener {
                override fun onItemSelected(
                    parent: AdapterView<*>?,
                    view: android.view.View?,
                    position: Int,
                    id: Long
                ) {
                    hitungTotal()
                }

                override fun onNothingSelected(parent: AdapterView<*>?) {}
            }

        inputJumlah.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) {}
            override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) {
                hitungTotal()
            }
            override fun afterTextChanged(s: Editable?) {}
        })

        btnSimpan.setOnClickListener { simpanTransaksi() }
        btnKembali.setOnClickListener { finish() }
    }

    private fun loadProduk() {
        ApiClient.instance.getProduk().enqueue(object : Callback<List<Produk>> {
            override fun onResponse(
                call: Call<List<Produk>>,
                response: Response<List<Produk>>
            ) {
                if (response.isSuccessful && response.body() != null) {
                    daftarProduk = response.body()!!

                    val adapter = ArrayAdapter(
                        this@TambahTransaksiActivity,
                        android.R.layout.simple_spinner_item,
                        daftarProduk.map {
                            "${it.nama_produk} - Rp ${it.harga.toInt()}"
                        }
                    )
                    adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                    spinnerProduk.adapter = adapter
                } else {
                    Toast.makeText(
                        this@TambahTransaksiActivity,
                        "Gagal memuat produk",
                        Toast.LENGTH_SHORT
                    ).show()
                }
            }

            override fun onFailure(call: Call<List<Produk>>, t: Throwable) {
                Toast.makeText(
                    this@TambahTransaksiActivity,
                    "Error: ${t.message}",
                    Toast.LENGTH_SHORT
                ).show()
            }
        })
    }

    private fun simpanTransaksi() {
        if (daftarProduk.isEmpty()) {
            Toast.makeText(this, "Produk belum tersedia", Toast.LENGTH_SHORT).show()
            return
        }

        val jumlah = inputJumlah.text.toString().toIntOrNull()
        if (jumlah == null || jumlah <= 0) {
            Toast.makeText(this, "Jumlah tidak valid", Toast.LENGTH_SHORT).show()
            return
        }

        val produk = daftarProduk[spinnerProduk.selectedItemPosition]
        val totalHarga = produk.harga * jumlah

        val kasir = getSharedPreferences("LOGIN_SESSION", MODE_PRIVATE)
            .getString("username", "Kasir")!!

        ApiClient.instance.tambahTransaksi(totalHarga, kasir)
            .enqueue(object : Callback<TransaksiResponse> {

                override fun onResponse(
                    call: Call<TransaksiResponse>,
                    response: Response<TransaksiResponse>
                ) {
                    if (response.isSuccessful && response.body()?.success == true) {

                        val idTransaksi = response.body()!!.id_transaksi

                        ApiClient.instance.TambahDetailTransaksi(
                            idTransaksi,
                            produk.id_produk,
                            produk.harga,
                            jumlah
                        ).enqueue(object : Callback<SimpleResponse> {

                            override fun onResponse(
                                call: Call<SimpleResponse>,
                                response: Response<SimpleResponse>
                            ) {
                                Toast.makeText(
                                    this@TambahTransaksiActivity,
                                    "✅ Transaksi berhasil disimpan",
                                    Toast.LENGTH_SHORT
                                ).show()
                                finish()
                            }

                            override fun onFailure(call: Call<SimpleResponse>, t: Throwable) {
                                Toast.makeText(
                                    this@TambahTransaksiActivity,
                                    "Detail transaksi gagal",
                                    Toast.LENGTH_SHORT
                                ).show()
                            }
                        })

                    } else {
                        Toast.makeText(
                            this@TambahTransaksiActivity,
                            "Gagal menyimpan transaksi",
                            Toast.LENGTH_SHORT
                        ).show()
                    }
                }

                override fun onFailure(call: Call<TransaksiResponse>, t: Throwable) {
                    Toast.makeText(
                        this@TambahTransaksiActivity,
                        "Error: ${t.message}",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }

    private fun hitungTotal() {
        if (daftarProduk.isEmpty()) return
        val jumlah = inputJumlah.text.toString().toIntOrNull() ?: 0
        val harga = daftarProduk[spinnerProduk.selectedItemPosition].harga
        val total = harga * jumlah
        txtTotal.text = "Total: Rp ${total.toInt()}"
    }
}
