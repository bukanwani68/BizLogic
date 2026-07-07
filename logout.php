<?php
// 1. Mulai atau panggil session yang sedang berjalan
session_start();

// 2. Kosongkan semua variabel session yang tersimpan (seperti id, username, nama_lengkap, dll)
session_unset();

// 3. Hancurkan/patahkan session dari server komputer
session_destroy();

// 4. Bersihkan cookie session jika ada (opsional, biar makin bersih & aman)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 5. Lempar kembali user ke halaman login dengan pesan sukses keluar
header("Location: login.php?pesan=Kamu telah berhasil keluar dari akun!");
exit;
?>