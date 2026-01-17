package com.nim2411500010.kasirmini.ui.produk

import android.content.Intent
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Produk

class ProdukAdapter(
    private val listProduk: List<Produk>
) : RecyclerView.Adapter<ProdukAdapter.ProdukViewHolder>() {

    inner class ProdukViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val tvNama: TextView = itemView.findViewById(R.id.tvNamaProduk)
        val tvHarga: TextView = itemView.findViewById(R.id.tvHarga)
        val tvStok: TextView = itemView.findViewById(R.id.tvStok)
        val tvKategori: TextView = itemView.findViewById(R.id.tvKategori)
        val btnEdit: Button = itemView.findViewById(R.id.btnEdit)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ProdukViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_produk, parent, false)
        return ProdukViewHolder(view)
    }

    override fun onBindViewHolder(holder: ProdukViewHolder, position: Int) {

        // ambil 1 produk
        val produk = listProduk[position]

        // set data ke view
        holder.tvNama.text = produk.nama_produk
        holder.tvHarga.text = "Rp ${produk.harga}"
        holder.tvStok.text = "Stok: ${produk.stok}"
        holder.tvKategori.text = produk.kategori

        holder.btnEdit.setOnClickListener {
            val intent = Intent(holder.itemView.context, EditProdukActivity::class.java)
            intent.putExtra("id_produk", produk.id_produk)
            intent.putExtra("nama_produk", produk.nama_produk)
            intent.putExtra("harga", produk.harga)
            intent.putExtra("stok", produk.stok)
            intent.putExtra("kategori", produk.kategori)
            holder.itemView.context.startActivity(intent)
        }
    }

    override fun getItemCount(): Int = listProduk.size
}
