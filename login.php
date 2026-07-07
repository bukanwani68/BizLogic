<?php
include 'koneksi.php';
// Jika sudah login, langsung lempar ke beranda
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BizLogic.co.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .gradient-blue { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 max-w-sm w-full p-8 space-y-6">
        <div class="text-center space-y-2">
            <div class="inline-flex items-center gap-2">
                <div class="w-8 h-8 gradient-blue rounded-xl flex items-center justify-center text-white font-bold text-base">B</div>
                <span class="text-lg font-bold text-blue-900">Biz<span class="text-blue-500">Logic</span></span>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Selamat Datang Kembali</h2>
        </div>

        <!-- Notifikasi jika lemparan dari proses ada error -->
        <?php if (isset($_GET['error'])) : ?>
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl p-3 text-xs font-semibold">
                ⚠️ <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['pesan'])) : ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl p-3 text-xs font-semibold">
                ✅ <?= htmlspecialchars($_GET['pesan']); ?>
            </div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST" class="space-y-4 text-xs">
            <div class="space-y-1.5">
                <label class="font-bold text-slate-600 block">Username</label>
                <input type="text" name="username" required placeholder="Masukkan username" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:border-blue-500">
            </div>
            <div class="space-y-1.5">
                <label class="font-bold text-slate-600 block">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="w-full gradient-blue text-white font-bold text-sm py-3.5 rounded-xl shadow-md transition transform hover:-translate-y-0.5">Masuk ke Akun 🚀</button>
        </form>

        <div class="text-center pt-2 border-t border-slate-100 text-[11px] text-slate-400 font-medium">
            Belum punya akun? <a href="register.php" class="text-blue-500 font-bold hover:underline">Daftar Akun Baru</a>
        </div>
    </div>
</body>
</html>