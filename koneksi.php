<?php
// Pastikan session dimulai di sini agar setiap file yang memanggil koneksi otomatis bisa pakai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Konfigurasi Database Lokal (XAMPP / Laragon)
$db_host = "localhost";
$db_user = "root";     // Default XAMPP adalah root
$db_pass = "";         // Default XAMPP adalah kosong/tanpa password
$db_name = "db_bizlogic";

// 2. Membuat Koneksi ke MySQL
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// 3. Validasi Koneksi (Pengecekan Error)
if (!$conn) {
    die("<div style='color: red; font-family: sans-serif; padding: 20px;'>
            <strong>Waduh, Koneksi Database Gagal!</strong><br>
            Pesan Error: " . mysqli_connect_error() . "
         </div>");
}

// 4. Set Charset ke UTF-8 agar karakter simbol/emotikon aman saat dibaca dari database
mysqli_set_charset($conn, "utf8mb4");

// Mengembalikan object koneksi jika dibutuhkan oleh file lain
return $conn;
?>