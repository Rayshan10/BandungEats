# 🍽️ BandungEats

BandungEats adalah aplikasi web berbasis **Laravel 12** yang menyediakan informasi resep makanan khas Bandung. Aplikasi ini memungkinkan pengguna untuk mencari resep, melihat detail resep, menyimpan resep favorit (bookmark), serta mengelola profil pengguna. Selain itu, aplikasi juga dilengkapi dengan dashboard admin untuk mengelola seluruh data resep dan pengguna.

---

## ✨ Fitur Utama

### 👥 User
- Registrasi akun
- Login & Logout
- Edit profil
- Upload foto profil
- Ganti password
- Melihat daftar resep
- Pencarian resep secara real-time
- Filter resep berdasarkan kategori
- Detail resep
- Bookmark resep favorit
- Melihat daftar bookmark
- Responsive Design

---

### 👨‍💼 Admin
- Dashboard Admin
- Kelola Resep (CRUD)
- Kelola User
- Statistik Dashboard
- Grafik jumlah resep per kategori

---

## 🍲 Kategori Resep

- 🌶️ Pedas
- 🍛 Gurih
- 🍰 Manis
- 🥟 Jajanan
- 🥣 Kuah
- 🥤 Minuman
- 🥘 Tumis

---

## 🛠️ Teknologi yang Digunakan

### Backend

- Laravel 12
- PHP 8.2+
- MySQL

### Frontend

- Blade Template
- Bootstrap 5
- JavaScript
- AJAX (Fetch API)
- Chart.js
- SweetAlert2

### Tools

- Composer
- Git
- GitHub
- Laragon

---

## 📂 Struktur Project

```
bandungeats
│
├── app
├── bootstrap
├── config
├── database
│   ├── migrations
│   ├── seeders
│   └── dataset
│
├── public
│
├── resources
│   ├── views
│   ├── css
│   └── js
│
├── routes
├── storage
└── README.md
```

---

## 🚀 Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/USERNAME/BandungEats.git
```

Masuk ke folder project

```bash
cd BandungEats
```

---

### 2. Install Dependency

```bash
composer install
```

---

### 3. Copy Environment

```bash
cp .env.example .env
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Atur Database

Edit file

```
.env
```

Contoh

```env
DB_DATABASE=bandungeats
DB_USERNAME=root
DB_PASSWORD=
```

---

### 6. Jalankan Migration

```bash
php artisan migrate
```

atau

```bash
php artisan migrate:fresh --seed
```

---

### 7. Storage Link

```bash
php artisan storage:link
```

---

### 8. Jalankan Server

```bash
php artisan serve
```

Buka

```
http://127.0.0.1:8000
```

---

## 👤 Default Admin

Admin dapat dibuat menggunakan Laravel Tinker.

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name'=>'Administrator',
    'email'=>'admin@gmail.com',
    'password'=>bcrypt('password'),
    'role'=>'admin'
]);
```

Login

```
Email    : admin@gmail.com
Password : admin123
```

---

## 📊 Dataset

Dataset resep berasal dari kumpulan resep makanan Indonesia yang kemudian diproses menggunakan **Smart Seeder**.

Fitur Smart Seeder:

- Klasifikasi resep otomatis
- Penentuan kategori menggunakan keyword scoring
- Pembagian dataset seimbang
- Pembuatan deskripsi otomatis
- Estimasi waktu memasak
- Estimasi tingkat kesulitan
- Randomisasi data

---

## 📷 Screenshot

### Halaman Home

> Tambahkan screenshot Home

### Halaman Resep

> Tambahkan screenshot Resep

### Detail Resep

> Tambahkan screenshot Detail Resep

### Bookmark

> Tambahkan screenshot Bookmark

### Dashboard Admin

> Tambahkan screenshot Dashboard

---

## 📈 Fitur yang Diimplementasikan

- Authentication
- Authorization
- CRUD Resep
- CRUD User
- Profile Management
- Upload Image
- Bookmark System
- Search
- Filter
- Pagination
- Responsive UI
- Chart Dashboard
- SweetAlert Notification
- Loading Animation
- Empty State
- Counter Animation
- Page Transition

---

## 📌 Future Improvements

- Sistem Rekomendasi Resep (SAW)
- Rating Resep
- Komentar Pengguna
- Riwayat Aktivitas
- Export Data
- Dashboard Analytics yang lebih lengkap

---

## 👨‍💻 Developer

**Rayshan Gani Putra**

Universitas Logistik dan Bisnis Internasional

Program Studi Teknik Informatika

---

## 📄 License

Project ini dibuat untuk keperluan akademik sebagai Tugas Akhir.