// ✅ Root-level Gradle build script
plugins {
    // Versi plugin Android & Kotlin ditentukan di sini saja
    id("com.android.application") version "8.13.2" apply false
    id("org.jetbrains.kotlin.android") version "2.0.0" apply false
}

// (Opsional) konfigurasi umum bila diperlukan
task<Delete>("clean") {
    delete(rootProject.buildDir)
}
