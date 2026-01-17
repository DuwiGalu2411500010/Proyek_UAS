package com.nim2411500010.kasirmini.ui.transaksi

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Transaksi

class TransaksiAdapter(private val list: List<Transaksi>) :
    RecyclerView.Adapter<TransaksiAdapter.ViewHolder>() {

    class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val tvTanggal: TextView = view.findViewById(R.id.tvTanggal)
        val tvTotal: TextView = view.findViewById(R.id.tvTotal)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_transaksi, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val transaksi = list[position]
        holder.tvTanggal.text = transaksi.tanggal
        holder.tvTotal.text = "Rp ${transaksi.total_harga}"
    }

    override fun getItemCount() = list.size
}
