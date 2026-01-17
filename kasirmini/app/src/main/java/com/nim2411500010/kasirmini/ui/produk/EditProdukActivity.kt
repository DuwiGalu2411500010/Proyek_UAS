package com.nim2411500010.kasirmini.ui.produk

import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.ProdukUpdateRequest
import com.nim2411500010.kasirmini.data.model.SimpleResponse
import com.nim2411500010.kasirmini.data.remote.ApiClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class EditProdukActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_edit_produk)

        val etNama = findViewById<EditText>(R.id.etNamaProduk)
        val etHarga = findViewById<EditText>(R.id.etHarga)
        val etStok = findViewById<EditText>(R.id.etStok)
        val etKategori = findViewById<EditText>(R.id.etKategori)
        val btnSimpan = findViewById<Button>(R.id.btnSimpan)
        val btnKembali = findViewById<Button>(R.id.btnKembali)


        val idProduk = intent.getIntExtra("id_produk", 0)
        etNama.setText(intent.getStringExtra("nama_produk"))
        etHarga.setText(intent.getIntExtra("harga", 0).toString())
        etStok.setText(intent.getIntExtra("stok", 0).toString())
        etKategori.setText(intent.getStringExtra("kategori"))

        btnSimpan.setOnClickListener {
            val request = ProdukUpdateRequest(
                id_produk = idProduk,
                nama_produk = etNama.text.toString(),
                harga = etHarga.text.toString().toInt(),
                stok = etStok.text.toString().toInt(),
                kategori = etKategori.text.toString()
            )

            ApiClient.instance.updateProduk(request)
                .enqueue(object : Callback<SimpleResponse> {

                    override fun onResponse(
                        call: Call<SimpleResponse>,
                        response: Response<SimpleResponse>
                    ) {
                        if (response.isSuccessful && response.body()?.success == true) {
                            Toast.makeText(
                                this@EditProdukActivity,
                                "Produk berhasil diperbarui",
                                Toast.LENGTH_SHORT
                            ).show()
                            finish()
                        } else {
                            Toast.makeText(
                                this@EditProdukActivity,
                                "Gagal memperbarui produk",
                                Toast.LENGTH_SHORT
                            ).show()
                        }
                    }

                    override fun onFailure(call: Call<SimpleResponse>, t: Throwable) {
                        Toast.makeText(this@EditProdukActivity, t.message, Toast.LENGTH_LONG).show()
                    }
                })
        }

        btnKembali.setOnClickListener {
            finish()
        }
    }
}
