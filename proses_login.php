<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query  = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Pencocokan teks biasa langsung (Tanpa hash/enkripsi)
        if ($password === $row['password']) {
            $_SESSION['login']         = true;
            $_SESSION['user_id']       = $row['id'];
            $_SESSION['username']      = $row['username'];
            $_SESSION['nama_lengkap']  = $row['nama_lengkap'];
            $_SESSION['universitas']   = $row['universitas'];
            $_SESSION['prodi']         = $row['prodi'];
            $_SESSION['kelas']         = $row['kelas'];

            if (strtolower($row['username']) === 'almeira') {
                header("Location: index.php?page=tutor-dashboard");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            header("Location: login.php?error=Password yang dimasukkan salah!");
            exit;
        }
    } else {
        header("Location: login.php?error=Username tidak ditemukan!");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}