# 📂 E-Archive (Laravel Drive Management System)

Aplikasi manajemen arsip digital (E-Archive) berbasis Web yang dibangun menggunakan Laravel. Aplikasi ini memungkinkan pengguna untuk membuat direktori (folder) bersarang, mengunggah file (maksimal 50MB), mengubah nama folder, serta mengunduh dan menghapus arsip secara aman.

## 🛠️ Tech Stack
- **Backend:** Laravel (PHP 8.x)
- **Frontend:** Tailwind CSS & Blade Templating (Vite Build)
- **Database:** MySQL
- **Authentication:** Laravel Breeze

---

## 🚀 Panduan Instalasi (Lokal / Development)

Ikuti langkah-langkah di bawah ini secara berurutan untuk menjalankan aplikasi ini di komputer lokal (localhost) Anda setelah melakukan *clone* atau mengunduh repositori ini.

### 1. Persyaratan Sistem (Prerequisites)
Pastikan komputer Anda sudah terinstal:
- [PHP](https://www.php.net/downloads) (Minimal versi 8.2)
- [Composer](https://getcomposer.org/)
- [Node.js & NPM](https://nodejs.org/)
- XAMPP / Laragon (Untuk MySQL Database)

### 2. Instalasi Library Backend (PHP)
Buka terminal/command prompt di dalam folder project, lalu jalankan perintah ini untuk mengunduh semua *dependency* Laravel:
```bash
composer install

### 3. Install Library Frontend
npm install

### 4. Configure .env
cp .env.example .env

### 5. Generate Application Key
php artisan key:generate

### 6. Migrate Database
php artisan migrate

### 7. Create Symlink
php artisan storage:link

### 8. Build Frontend Assets
npm run build

### 9. Run server
php artisan serve