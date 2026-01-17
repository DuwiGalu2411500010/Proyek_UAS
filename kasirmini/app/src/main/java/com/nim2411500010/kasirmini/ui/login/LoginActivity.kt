package com.nim2411500010.kasirmini.ui.login

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.ProgressBar
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import com.google.android.material.textfield.TextInputEditText
import com.nim2411500010.kasirmini.R
import com.nim2411500010.kasirmini.data.remote.ApiClient
import com.nim2411500010.kasirmini.data.remote.LoginResponse
import com.nim2411500010.kasirmini.ui.main.MainActivity
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LoginActivity : AppCompatActivity() {

    private lateinit var etUsername: TextInputEditText
    private lateinit var etPassword: TextInputEditText
    private lateinit var btnLogin: Button
    private lateinit var progress: ProgressBar

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        val pref = getSharedPreferences("LOGIN_SESSION", MODE_PRIVATE)
        if (pref.getBoolean("isLogin", false)) {
            startActivity(Intent(this, MainActivity::class.java))
            finish()
            return
        }

        setContentView(R.layout.activity_login)

        etUsername = findViewById(R.id.etUsername)
        etPassword = findViewById(R.id.etPassword)
        btnLogin = findViewById(R.id.btnLogin)
        progress = findViewById(R.id.progressLogin)

        btnLogin.setOnClickListener {
            login()
        }
    }

    private fun login() {
        val username = etUsername.text?.toString()?.trim() ?: ""
        val password = etPassword.text?.toString()?.trim() ?: ""

        if (username.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Username dan password wajib diisi", Toast.LENGTH_SHORT).show()
            return
        }

        progress.visibility = View.VISIBLE
        btnLogin.isEnabled = false

        ApiClient.instance.login(username, password)
            .enqueue(object : Callback<LoginResponse> {

                override fun onResponse(
                    call: Call<LoginResponse>,
                    response: Response<LoginResponse>
                ) {
                    progress.visibility = View.GONE
                    btnLogin.isEnabled = true

                    if (!response.isSuccessful || response.body() == null) {
                        Toast.makeText(
                            this@LoginActivity,
                            "Response tidak valid",
                            Toast.LENGTH_SHORT
                        ).show()
                        return
                    }

                    val res = response.body()!!

                    if (res.success) {
                        val pref = getSharedPreferences("LOGIN_SESSION", MODE_PRIVATE)
                        pref.edit()
                            .putBoolean("isLogin", true)
                            .putInt("id_admin", res.data!!.id_admin)
                            .putString("username", res.data.username)
                            .putString("nama_lengkap", res.data.nama_lengkap)
                            .apply()

                        Toast.makeText(
                            this@LoginActivity,
                            "Login berhasil",
                            Toast.LENGTH_SHORT
                        ).show()

                        startActivity(Intent(this@LoginActivity, MainActivity::class.java))
                        finish()

                    } else {
                        AlertDialog.Builder(this@LoginActivity)
                            .setTitle("Login gagal")
                            .setMessage(res.message)
                            .setPositiveButton("OK", null)
                            .show()
                    }
                }

                override fun onFailure(call: Call<LoginResponse>, t: Throwable) {
                    progress.visibility = View.GONE
                    btnLogin.isEnabled = true
                    Toast.makeText(
                        this@LoginActivity,
                        "Koneksi gagal: ${t.message}",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }
}