package com.nim2411500010.kasirmini.data.remote

data class LoginResponse(
    val success: Boolean,
    val message: String,
    val data: AdminData?
)

data class AdminData(
    val id_admin: Int,
    val username: String,
    val nama_lengkap: String
)
