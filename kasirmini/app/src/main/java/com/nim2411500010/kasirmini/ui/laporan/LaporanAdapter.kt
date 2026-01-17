package com.nim2411500010.kasirmini.ui.laporan

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.model.Laporan

class LaporanAdapter(
    private val list: List<Laporan>,
    private val onClick: (Laporan) -> Unit
) : RecyclerView.Adapter<LaporanAdapter.ViewHolder>() {

    inner class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val tvTanggal: TextView = view.findViewById(R.id.tvTanggal)
        val tvTotal: TextView = view.findViewById(R.id.tvTotal)
        val tvKasir: TextView = view.findViewById(R.id.tvKasir)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_laporan, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val item = list[position]
        holder.tvTanggal.text = item.tanggal
        holder.tvTotal.text = "Rp ${item.total_harga.toInt()}"
        holder.tvKasir.text = item.kasir

        holder.itemView.setOnClickListener {
            onClick(item)
        }
    }

    override fun getItemCount(): Int = list.size
}
