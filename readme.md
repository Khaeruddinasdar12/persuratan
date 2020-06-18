<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Instalasi
* Kebutuhan
    + Xampp
    + Composer

1. Download atau clone aplikasi ini.
2. Akses foldernya di cmd atau terminal lalu ketikkan ```composer install``` (koneksi internet).
3. Ubah nama file ```.env.example``` menjadi ```.env```
4. buat database di phpmyadmin, lalu buka file ```.env``` pada no. 3
5. ubah
    ```
    APP_NAME=Laravel

    DB_DATABASE=homestead 
    DB_USERNAME=homestead 
    DB_PASSWORD=secret 
    ```
    Menjadi
    ```
    APP_NAME=nama_aplikasi_anda

    DB_DATABASE=nama_database_anda 
    DB_USERNAME=user_database_anda
    DB_PASSWORD=password_database_anda 
    ```
6. Buka cmd kembali lalu ketikkan ```php artisan key:generate```
7. Masih di cmd ketikkan perintah ```php artisan storage:link```
8. Masih di cmd ketikkan perintah ```php artisan serve```
9. buka browser lalu akses ```localhost:8000```
10. Anda akan secara otomatis memiliki akun yang bisa digunakan untuk login yaitu
    > email : khaeruddinasdar12@gmail.com <br>
    > pass : 12345678

11. Selamat Menikmati. Sekian Dan Terimakasih.
