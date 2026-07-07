<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - BizLogic.co.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .gradient-blue { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 max-w-md w-full p-6 sm:p-8 space-y-5">
        <div class="text-center space-y-1">
            <h2 class="text-xl font-bold text-slate-900">Buat Akun BizLogic</h2>
            <p class="text-xs text-slate-400">Isi data dirimu dengan lengkap</p>
        </div>

        <?php if (isset($_GET['error'])) : ?>
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl p-3 text-xs font-semibold">
                ⚠️ <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="proses_register.php" method="POST" class="space-y-3.5 text-xs">
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="font-bold text-slate-600">NPM / NIM</label>
                    <input type="text" name="npm" required placeholder="06512..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
                </div>
                <div class="space-y-1">
                    <label class="font-bold text-slate-600">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required placeholder="Nama Lengkap" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="font-bold text-slate-600">Username</label>
                    <input type="text" name="username" required placeholder="Untuk login" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
                </div>
                <div class="space-y-1">
                    <label class="font-bold text-slate-600">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
                </div>
            </div>

            <div class="space-y-1">
                <label class="font-bold text-slate-600">Universitas Kampus</label>
                <input type="text" name="universitas" required placeholder="Contoh: Universitas Pakuan" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="font-bold text-slate-600">Program Studi</label>
                    <input type="text" name="prodi" required placeholder="Contoh: Bisnis Digital" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
                </div>
                <div class="space-y-1">
                    <label class="font-bold text-slate-600">Kelas</label>
                    <input type="text" name="kelas" required placeholder="Contoh: Kelas 4F" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5">
                </div>
            </div>

            <button type="submit" class="w-full gradient-blue text-white font-bold text-sm py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 mt-2">Daftar Sekarang ✨</button>
        </form>

        <div class="text-center pt-2 border-t border-slate-100 text-[11px] text-slate-400 font-medium">
            Sudah punya akun? <a href="login.php" class="text-blue-500 font-bold hover:underline">Masuk di sini</a>
        </div>
    </div>
</body>
</html>