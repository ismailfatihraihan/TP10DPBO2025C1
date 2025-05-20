Saya Ismail Fatih Raihan dengan NIM 2307840 mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.  


# Sistem Manajemen Resep  
Sistem Manajemen Resep adalah aplikasi web berbasis PHP yang memungkinkan pengguna untuk mengelola resep masakan, bahan-bahan, dan hubungan antara resep dan bahan. Aplikasi ini dibangun menggunakan arsitektur MVVM (Model-View-ViewModel) dan menggunakan TailwindCSS untuk tampilan yang modern.

## Desain Program (Arsitektur MVVM)

Aplikasi ini menggunakan arsitektur MVVM (Model-View-ViewModel) yang membagi komponen aplikasi menjadi tiga bagian utama:

### 1. Model

Model bertanggung jawab untuk operasi database dan representasi data. Terdapat tiga model utama:

- **Recipe.php**: Menangani operasi CRUD untuk tabel resep
- **Ingredient.php**: Menangani operasi CRUD untuk tabel bahan
- **RecipeIngredient.php**: Menangani operasi CRUD untuk tabel hubungan resep-bahan

Model berinteraksi langsung dengan database menggunakan PDO dan prepared statements untuk keamanan.

### 2. ViewModel

ViewModel berfungsi sebagai perantara antara Model dan View. ViewModel menangani logika bisnis dan manipulasi data. Terdapat tiga ViewModel utama:

- **RecipeViewModel.php**: Menghubungkan Recipe Model dengan View
- **IngredientViewModel.php**: Menghubungkan Ingredient Model dengan View
- **RecipeIngredientViewModel.php**: Menghubungkan RecipeIngredient Model dengan View

ViewModel menyediakan data yang sudah diproses untuk ditampilkan di View dan menangani input dari pengguna.

### 3. View

View bertanggung jawab untuk menampilkan antarmuka pengguna. View terdiri dari file-file PHP yang berisi HTML dan TailwindCSS. Terdapat beberapa View utama:

- **views/recipes/**: Tampilan untuk manajemen resep
- **views/ingredients/**: Tampilan untuk manajemen bahan
- **views/recipe_ingredients/**: Tampilan untuk manajemen hubungan resep-bahan
- **views/layout.php**: Template utama yang digunakan oleh semua halaman

## Alur Aplikasi

### 1. Inisialisasi Aplikasi

1. File `index.php` berfungsi sebagai entry point aplikasi
2. Aplikasi memeriksa parameter URL untuk menentukan view dan action yang diminta
3. Database diinisialisasi dan tabel dibuat jika belum ada
4. ViewModel yang sesuai diinisialisasi berdasarkan view yang diminta

### 2. Alur Request-Response

#### GET Request:
1. Aplikasi menerima parameter dari URL (view, action, id)
2. ViewModel yang sesuai diinisialisasi
3. Jika action adalah 'index', data diambil dari database melalui Model
4. Jika action adalah 'edit' atau 'view', data spesifik diambil berdasarkan ID
5. View yang sesuai ditampilkan dengan data dari ViewModel

#### POST Request:
1. Aplikasi menerima data form dari pengguna
2. Data divalidasi dan diproses oleh ViewModel
3. ViewModel memanggil Model untuk menyimpan data ke database
4. Pengguna diarahkan ke halaman yang sesuai setelah operasi selesai

### 3. Alur CRUD

#### Create:
1. Pengguna mengakses form pembuatan (resep/bahan/hubungan)
2. Pengguna mengisi data dan mengirim form
3. ViewModel memvalidasi data dan memanggil Model untuk menyimpan data
4. Pengguna diarahkan ke halaman indeks

#### Read:
1. Pengguna mengakses halaman indeks atau detail
2. ViewModel mengambil data dari Model
3. Data ditampilkan di View

#### Update:
1. Pengguna mengakses form edit dengan ID tertentu
2. ViewModel mengambil data dari Model berdasarkan ID
3. Pengguna mengubah data dan mengirim form
4. ViewModel memvalidasi data dan memanggil Model untuk memperbarui data
5. Pengguna diarahkan ke halaman indeks

#### Delete:
1. Pengguna mengklik tombol hapus dengan ID tertentu
2. ViewModel memanggil Model untuk menghapus data
3. Pengguna diarahkan ke halaman indeks

## Dokumentasi  


https://github.com/user-attachments/assets/fd15a7f8-3de3-46d0-a930-c09f00c7948e


