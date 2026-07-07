<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $npm          = mysqli_real_escape_string($conn, $_POST['npm']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $username     = mysqli_real_escape_string($conn, $_POST['username']);
    $password     = mysqli_real_escape_string($conn, $_POST['password']); // Menggunakan teks biasa
    $universitas  = mysqli_real_escape_string($conn, $_POST['universitas']);
    $prodi        = mysqli_real_escape_string($conn, $_POST['prodi']);
    $kelas        = mysqli_real_escape_string($conn, $_POST['kelas']);

    // Cek dulu apakah username sudah pernah dipakai orang lain
    $cek_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        header("Location: register.php?error=Username sudah dipakai! Pilih nama lain.");
        exit;
    }

    // Eksekusi masukkan data baru ke tabel
    $query_reg = "INSERT INTO `users` (`npm`, `nama_lengkap`, `username`, `password`, `universitas`, `prodi`, `kelas`) 
                  VALUES ('$npm', '$nama_lengkap', '$username', '$password', '$universitas', '$prodi', '$kelas')";

    if (mysqli_query($conn, $query_reg)) {
        header("Location: login.php?pesan=Pendaftaran Berhasil! Silakan masuk.");
        exit;
    } else {
        header("Location: register.php?error=Gagal mendaftar database bermasalah: " . mysqli_error($conn));
        exit;
    }
} else {
    header("Location: register.php");
    exit;
}