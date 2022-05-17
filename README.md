## Introduce
Ruang Kelas adalah aplikasi layaknya seperti google classroom,
guru atau pemilik kelas dapat membuat tugas ke siswa yang bergabung ke kelasnya,
serta pemilik kelas dapat memberikan nilai kepada siswa yang mengumpulkan tugasnya masing-masing

-fitur
 1.authentication
 2.membuat kelas
 3.bergabung ke kelas
 4.mencari kelas dengan kode kelas
 5.membuat tugas
 6.memberikan nilai ke siswa
 7.profile
 8.etc
 
note: proyek ini dibuat dengan sesederhana mungkin dikarenakan keterbatasan waktu

## Installation
Clone project terlebih dahulu
```sh
git clone https://github.com/rizkitirta/ruang-kelas.git
```

Setelah itu composer install
```sh
composer install
```

## Database
Buat database pada postgress panel
```sh
dengan nama database : ruang_kelas
kemudian sesuaikan config `.env` pada project laravel nya
```

Setelah itu jalakan artisan dengan langka sebagai berikut :
```sh
`1.` php artisan migrate
```

## Development
```sh
php artisan serve
```

```sh
php artisan storage:link
```

## Usage
```python
langsung buka http://127.0.0.1:8000/
```
# **HAPPY CODING ❤💕**
