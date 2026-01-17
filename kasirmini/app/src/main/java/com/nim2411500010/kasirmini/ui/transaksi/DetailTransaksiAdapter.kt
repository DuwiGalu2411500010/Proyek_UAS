package com.nim2411500010.kasirmini.ui.transaksi

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.DetailTransaksi

class DetailTransaksiAdapter(
    private val list: List<DetailTransaksi>
) : RecyclerView.Adapter<DetailTransaksiAdapter.ViewHolder>() {

    inner class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val tvNama: TextView = view.findViewById(R.id.tvNamaProduk)
        val tvHarga: TextView = view.findViewById(R.id.tvHarga)
        val tvJumlah: TextView = view.findViewById(R.id.tvJumlah)
        val tvSubtotal: TextView = view.findViewById(R.id.tvSubtotal)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_detail_transaksi, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val item = list[position]
        holder.tvNama.text = item.nama_produk
        holder.tvHarga.text = "Rp ${item.harga.toInt()}"
        holder.tvJumlah.text = "x${item.jumlah}"
        holder.tvSubtotal.text = "Rp ${item.subtotal.toInt()}"
    }

    override fun getItemCount(): Int = list.size
}
