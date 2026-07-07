<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['login'])) {
    
    $user_id     = $_SESSION['user_id'];
    $nama_matkul = mysqli_real_escape_string($conn, $_POST['tutor_matkul']);
    $topik       = mysqli_real_escape_string($conn, $_POST['tutor_topik']);
    $week        = mysqli_real_escape_string($conn, $_POST['tutor_week']);
    $metode      = mysqli_real_escape_string($conn, $_POST['tutor_method']);
    $harga       = intval($_POST['tutor_price']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['tutor_desc']);
    
    $target_data = "";

    // JIKA METODE ADALAH PDF, PROSES FILE UPLOADNYA
    if ($metode === 'pdf') {
        if (isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] === 0) {
            $nama_file = $_FILES['file_pdf']['name'];
            $tmp_file  = $_FILES['file_pdf']['tmp_name'];
            
            // Buat nama unik agar tidak tabrakan di server folder
            $nama_file_baru = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $nama_file);
            
            // Lokasi folder penyimpanan (pastikan folder 'uploads' sudah kamu buat)
            $folder_tujuan = "uploads/";
            if (!is_dir($folder_tujuan)) {
                mkdir($folder_tujuan, 0777, true);
            }

            if (move_uploaded_file($tmp_file, $folder_tujuan . $nama_file_baru)) {
                $target_data = $nama_file_baru; // Nama file disimpan ke kolom target_data
            } else {
                echo "<script>alert('Gagal mengunggah file PDF ke server!'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Harap sertakan file PDF yang valid!'); window.history.back();</script>";
            exit;
        }
    } else {
        // JIKA METODE BUKAN PDF (TEXT BIASA / LINK ZOOM / LOKASI)
        $target_data = mysqli_real_escape_string($conn, $_POST['target_data']);
    }

    // Jalankan query SQL simpan
    $query_insert = "INSERT INTO `courses` (`user_id`, `nama_matkul`, `topik`, `week`, `metode`, `harga`, `deskripsi`, `target_data`) 
                     VALUES ('$user_id', '$nama_matkul', '$topik', '$week', '$metode', '$harga', '$deskripsi', '$target_data')";

    if (mysqli_query($conn, $query_insert)) {
        echo "<script>
                alert('🚀 Sukses! Solusi belajar barumu berhasil diterbitkan!');
                window.location.href = 'index.php?page=tutor-dashboard';
              </script>";
        exit;
    } else {
        echo "Gagal menyimpan data ke database: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit;
}