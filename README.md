# 🗺️ TRAVELGIS

**TRAVELGIS** adalah aplikasi WebGIS berbasis Laravel dan Leaflet yang menampilkan informasi transportasi umum di Kota Yogyakarta, termasuk peta jalur dan halte Trans Jogja.

---

## 🔍 Fitur Utama

- Menampilkan peta interaktif dengan Leaflet
- Visualisasi halte Trans Jogja dalam bentuk marker
- Jalur trayek bus menggunakan data dari OpenStreetMap (Overpass API)
- Filter trayek berdasarkan nama
- Heatmap persebaran halte
- Statistik jumlah halte dan jalur
- Desain responsif dan siap demonstrasi offline

---

## 🗃️ Teknologi yang Digunakan

- Laravel 10 (PHP)
- Leaflet.js
- GeoJSON
- Tailwind CSS
- Overpass Turbo API (untuk pengambilan data awal)

---

## 📂 Struktur Folder Penting

```
/public/data/
  ├─ halte.geojson     → Data titik halte
  └─ jalur.geojson     → Data garis trayek bus

/resources/views/
  └─ map.blade.php     → Halaman utama peta

/routes/web.php        → Routing aplikasi
```

---

## 🚀 Cara Menjalankan Secara Lokal

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/username/travelgis_nama_NIU.git
   cd travelgis_nama_NIU
   ```

2. **Install dependensi:**
   ```bash
   composer install
   ```

3. **Salin file `.env` dan generate key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```

5. **Buka di browser:**
   ```
   http://localhost:8000
   ```

---

## 📌 Catatan

- Aplikasi ini tidak menggunakan database untuk demo dasar (opsional).
- Data GeoJSON diambil dari Overpass Turbo dan disimpan lokal.
- Kompatibel untuk demonstrasi offline di kelas/praktikum.

---

## 🧑‍💻 Pengembang

- **Nama:** Frendy Ade Wicaksono
- **NIM:** 23/523180/SV/23868
- **Prodi:** D4 Sistem Informasi Geografis, UGM

---

## 📖 Lisensi

Proyek ini bersifat open-source untuk keperluan pendidikan dan demonstrasi.
