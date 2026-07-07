<?php
include 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);
    $user_id   = $_SESSION['user_id'];

    // Cek apakah sudah pernah beli
    $cek = mysqli_query($conn, "SELECT * FROM `transactions` WHERE `user_id` = '$user_id' AND `course_id` = '$course_id'");
    
    if (mysqli_num_rows($cek) == 0) {
        // Masukkan data transaksi
        $query = "INSERT INTO `transactions` (`user_id`, `course_id`, `status`) VALUES ('$user_id', '$course_id', 'success')";
        mysqli_query($conn, $query);
    }

    // PENTING: Dilempar ke halaman transaksi khusus, bukan ke index!
    header("Location: halaman_transaksi.php?id=" . $course_id);
    exit;
} else {
    header("Location: index.php");
    exit;
}