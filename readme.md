<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Tools
1. Xampp
2. Composer

Instalasi
1. Buat database di phpmyadmin dengan nama `persuratan`
2. Extract file ini, lalu pindahkan folder projectnya(nama foldernya adalah persuratan) ke localdisk D atau C
3. Buka CMD dan masuk ke directory folder projectnya (mis. D:\persuratan> _command_)
4. Ketikkan perintah `php artisan serve` (selama menjalankan aplikasi, cmd ini tidak boleh ditutup atau di hentikan)
5. Buka CMD baru dan masuk lagi ke folder projectnya ketikkan perintah `php artisan migrate:refresh --seed`
6. Masih di CMD yang sama pada nomor 5, ketikkan perintah `php artisan storage:link`
7. Aplikasi siap dipakai, akses `localhost:8000` di browser
8. Akan tampil halaman login, username `khaeruddinasdar12@gmail.com` dan password `12345678`
9. untuk mengganti username atau data admin hanya bisa dilakukan di phpmyadmin secara manual.
