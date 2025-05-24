# Ringkasan Proyek & Kesimpulan

## Proyek **"Aplikasi Manajemen Pegawai CRUD dengan Sistem Login"** 

Merupakan sebuah aplikasi web full-stack yang dirancang untuk mendemonstrasikan operasi dasar Create, Read, Update, dan Delete (CRUD) data pegawai, yang diamankan dengan sistem login administrator.

Aplikasi ini dibangun menggunakan serangkaian teknologi modern dan standar industri, yang mencakup:

* **Frontend (Client-Side):**
    * **React.js:** Sebuah pustaka JavaScript yang populer untuk membangun antarmuka pengguna yang interaktif dan dinamis.
    * **HTML5 & CSS3:** Struktur dan styling dasar halaman web.
    * **JavaScript (ES6+):** Bahasa pemrograman utama untuk logika frontend.
    * **React Router DOM:** Untuk mengelola navigasi dan routing di dalam aplikasi single-page.

* **Backend (Server-Side):**
    * **PHP:** Bahasa scripting sisi server yang kuat dan banyak digunakan untuk memproses logika bisnis dan berinteraksi dengan database.
    * **API RESTful Sederhana:** Backend menyediakan endpoint API untuk semua operasi CRUD dan autentikasi.
    * **Manajemen Sesi PHP:** Digunakan untuk mengelola status login administrator.

* **Database:**
    * **Microsoft SQL Server:** Sistem manajemen database relasional yang andal untuk menyimpan data pegawai dan kredensial admin.
    * **SQL:** Bahasa query standar untuk berinteraksi dengan database.

* **Lingkungan Server (Lokal):**
    * **IIS (Internet Information Services):** Web server yang berjalan di lingkungan Windows untuk melayani aplikasi React dan mengeksekusi skrip PHP.

**Fungsionalitas Utama:**

1.  **Autentikasi Administrator:**
    * Halaman login khusus untuk administrator.
      
    ![image](https://github.com/user-attachments/assets/c263d7fc-d8c3-4144-b728-03ab0143b84e)

    * Verifikasi kredensial (username dan password) terhadap data di database.<br>
      a. Apabila Password salah:
      
      ![image](https://github.com/user-attachments/assets/1f6ccf50-b572-444d-a7a9-3540c0106085)

      b. Apabila Password benar:

      ![image](https://github.com/user-attachments/assets/0e015423-8b4c-448f-938d-2d0e23c8ace4)

    * Penggunaan sesi PHP untuk menjaga status login.

      ![Recording2025-05-24170328-ezgif com-video-to-gif-converter](https://github.com/user-attachments/assets/a5139946-fd2d-455f-b1a5-8a09d31b0325)

  
1.  **Manajemen Data Pegawai (CRUD):**
    * **Create:** Menambahkan data pegawai baru melalui form.
    * **Read:** Menampilkan daftar semua pegawai dalam format tabel.
    * **Update:** Mengedit data pegawai yang sudah ada.
    * **Delete:** Menghapus data pegawai dari database.
    * Semua operasi CRUD ini dilindungi dan hanya bisa diakses setelah administrator berhasil login.
  
2.  **Routing Terproteksi:** Halaman dashboard manajemen pegawai hanya bisa diakses oleh pengguna yang sudah terautentikasi.

Proyek ini telah melalui proses development dan debugging yang komprehensif, mencakup konfigurasi server, penanganan error, koneksi database, hingga implementasi fitur keamanan dasar seperti password dan proteksi sesi. Kode sumber lengkap proyek ini tersedia di repositori GitHub ini sebagai referensi dan portofolio.

---
