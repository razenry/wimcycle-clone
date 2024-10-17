# Wimcycle Clone - PHP MVC

Wimcycle Clone adalah replika dari website Wimcycle yang dibangun menggunakan arsitektur PHP MVC custom dan Bootstrap 5. Proyek ini bertujuan untuk menunjukkan penggunaan arsitektur modular MVC dalam mengelola kode PHP secara efisien sekaligus menghadirkan desain responsif dengan teknologi front-end modern.

## Sistem dan Fitur Utama

- **Arsitektur PHP MVC Custom**: Mengorganisasikan kode dalam struktur MVC yang memisahkan logika aplikasi menjadi tiga bagian utama—Model, View, dan Controller—sehingga memudahkan pengembangan dan pemeliharaan aplikasi.
  
- **Bootstrap 5**: Framework desain responsif yang mengutamakan mobile-first, memberikan tampilan antarmuka yang modern, bersih, dan intuitif di semua perangkat.

- **Manajemen Produk**: Mengimplementasikan fitur CRUD (Create, Read, Update, Delete) untuk memungkinkan pengguna mengelola produk secara mudah, mulai dari menambah hingga menghapus produk.

- **Manajemen Halaman**: CMS sederhana untuk mengelola halaman statis seperti beranda, halaman "about", dan kontak, yang memungkinkan perubahan konten dilakukan dengan cepat.

- **Navigasi Responsif**: Navbar yang dioptimalkan untuk tampilan mobile, sehingga pengguna dapat dengan mudah bernavigasi di berbagai ukuran layar.

- **Desain Responsif**: Desain yang disesuaikan agar tampilan website tetap menarik dan fungsional di berbagai ukuran layar, dari smartphone hingga desktop.

## Struktur Folder

Proyek ini disusun dengan struktur direktori yang rapi untuk memudahkan navigasi dan pemeliharaan kode.

```bash
├── app
│   ├── controllers    # Berkas controller untuk menangani logika aplikasi
│   ├── models         # Berkas model untuk berinteraksi dengan database
│   ├── views          # Template tampilan halaman (View)
│   └── config         # Berkas konfigurasi aplikasi
├── public
│   ├── assets         # Berkas front-end seperti CSS, JS, dan gambar
│   ├── storage        # Direktori untuk berkas upload (misalnya gambar)
│   └── index.php      # Entry point aplikasi
└── system             # Berkas inti untuk mendukung fungsi MVC

Teknologi yang Digunakan
PHP (MVC Custom): Aplikasi ini dibangun dengan struktur MVC khusus, yang memisahkan routing, logika bisnis, dan tampilan untuk meningkatkan skalabilitas dan maintainability.

MySQL: Digunakan sebagai basis data untuk menyimpan informasi produk dan halaman, mendukung pengelolaan konten secara efektif.

Bootstrap 5: Framework front-end modern yang membantu membangun desain responsif dan elegan, dengan komponen UI yang mudah digunakan.

Apache/Nginx: Server web yang bertanggung jawab untuk melayani aplikasi ini, memastikan permintaan HTTP ditangani dengan cepat dan efisien.

Alur Aplikasi
Aplikasi ini berfungsi sebagai CMS sederhana yang memungkinkan pengelolaan produk dan halaman. Admin dapat menambah, memperbarui, atau menghapus produk melalui antarmuka yang mudah digunakan. Pengguna juga dapat bernavigasi ke berbagai halaman, termasuk beranda dan halaman produk, dengan pengalaman pengguna yang optimal di berbagai perangkat.

Halaman Utama: Menampilkan daftar produk unggulan dan informasi terkini.
Halaman Produk: Menyediakan daftar lengkap produk dengan opsi untuk melihat detail atau mengelola produk jika sebagai admin.
Halaman CMS: Fitur admin untuk mengelola konten seperti produk dan halaman statis.
Pengembangan dan Kontribusi
Proyek ini dikembangkan sebagai contoh bagaimana membangun aplikasi web dengan arsitektur PHP MVC yang terstruktur. Jika Anda tertarik untuk berkontribusi, Anda bisa:

Melaporkan bug melalui Issues di GitHub.
Mengajukan perbaikan atau fitur baru melalui pull request.
Memberikan saran atau umpan balik untuk meningkatkan proyek ini.
Kami menyambut kontribusi dari siapa saja yang ingin berkontribusi pada proyek ini, baik dalam bentuk kode, dokumentasi, maupun desain.

Lisensi
Proyek ini dilisensikan di bawah lisensi MIT, yang berarti Anda bebas menggunakan, menyalin, memodifikasi, dan mendistribusikan proyek ini dengan syarat mencantumkan atribusi kepada penulis asli.

Penulis: Razenry.code