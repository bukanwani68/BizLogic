<?php
include 'koneksi.php';

// Proteksi: Pastikan user sudah login dan akunnya adalah Almeira (Tutor)
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || strtolower($_SESSION['username']) !== 'almeira') {
    header("Location: index.php");
    exit;
}

// AMBIL SEMUA DATA SESSION AGAR TIDAK UNDEFINED DI NAVBAR
$username      = $_SESSION['username'];
$nama_lengkap  = $_SESSION['nama_lengkap'];
$user_id       = $_SESSION['user_id'];
$kelas         = isset($_SESSION['kelas']) ? $_SESSION['kelas'] : '-';
$prodi         = isset($_SESSION['prodi']) ? $_SESSION['prodi'] : '-';
$universitas   = isset($_SESSION['universitas']) ? $_SESSION['universitas'] : 'Universitas Pakuan';

// Definisikan variabel page buatan untuk keperluan keaktifan link navbar
$page = 'tutor-dashboard'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Solusi Belajar - BizLogic.co.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .gradient-blue { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col justify-between">

    <!-- NAVBAR ATAS (SUDAH DIPERBAIKI DENGAN VARIABEL SESSION YANG VALID) -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 px-6 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php?page=home" class="flex items-center gap-2">
                <div class="w-9 h-9 gradient-blue rounded-xl flex items-center justify-center text-white font-bold text-lg">B</div>
                <span class="text-xl font-bold tracking-tight text-blue-900">Biz<span class="text-blue-500">Logic</span></span>
            </a>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="index.php?page=home" class="hover:text-blue-600 transition">Beranda</a>
                <span class="text-slate-200">|</span>
                
                <?php if (strtolower($username) === 'almeira') : ?>
                    <a href="index.php?page=tutor-dashboard" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">👨‍🏫 Dashboard Tutor</a>
                <?php endif; ?>
                
                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold"><?= htmlspecialchars($kelas . " - " . $prodi) ?></span>
                <a href="logout.php" class="text-red-500 hover:text-red-700 font-bold text-xs">Keluar ↩</a>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-900"><?= htmlspecialchars($nama_lengkap) ?></p>
                    <p class="text-[10px] text-slate-400"><?= htmlspecialchars($universitas) ?></p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-blue-500/20 flex items-center justify-center bg-slate-200 text-blue-900 font-bold uppercase">
                    <?= htmlspecialchars(substr($username, 0, 1)) ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- LAYOUT UTAMA (GRID 3 KOLOM) -->
    <main class="max-w-5xl w-full mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-6 flex-1">
        
        <!-- Bagian Kiri: Profil Almeira -->
        <div class="bg-white rounded-2xl border p-6 shadow-sm space-y-4 text-center text-xs align-top h-fit">
            <div class="w-14 h-14 bg-blue-600 text-white rounded-full mx-auto flex items-center justify-center font-bold text-lg">AL</div>
            <h3 class="font-bold text-base text-slate-900"><?= htmlspecialchars($nama_lengkap) ?></h3>
            <p class="text-amber-600 font-bold">🎖️ Certified Peer-Tutor</p>
            <div class="border-t pt-4 space-y-2 text-left">
                <div class="flex justify-between"> <span class="text-slate-400">Total Siswa</span> <span class="font-bold">171 Mhs</span> </div>
                <div class="flex justify-between"> <span class="text-slate-400">Rating</span> <span class="font-bold">⭐ 4.95</span> </div>
            </div>
        </div>

        <!-- Bagian Kanan: Kontainer Form -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border p-6 sm:p-8 shadow-sm space-y-4">
                
                <!-- Header Form -->
                <div class="border-b pb-2 flex justify-between items-center">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">🛠️ Buat Solusi Belajar Baru</h2>
                        <p class="text-[11px] text-slate-400">Isi data bimbingan atau rangkuman materi di bawah ini.</p>
                    </div>
                    <a href="index.php?page=tutor-dashboard" class="text-slate-400 hover:text-slate-600 font-bold text-xs">❌ Batal</a>
                </div>

                <!-- Form Input -->
                <form action="proses_tambah_course.php" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-600">Nama Mata Kuliah</label>
                            <input type="text" name="tutor_matkul" required placeholder="Contoh: UI/UX Design atau Akuntansi" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-600">Topik / Judul Solusi Materi</label>
                            <input type="text" name="tutor_topik" required placeholder="Contoh: User Research & Wireframing" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-600">Pertemuan Ke (Week)</label>
                            <input type="text" name="tutor_week" required placeholder="Contoh: Week 10" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-600">Metode Belajar</label>
                            <select name="tutor_method" id="metode_select_halaman" required class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition cursor-pointer">
                                <option value="video">📺 Video Belajar</option>
                                <option value="pdf">📄 Summary PDF</option>
                                <option value="online">💻 Sesi Online</option>
                                <option value="offline">🤝 Sesi Offline</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-600">Harga Jual (Rp)</label>
                            <input type="number" name="tutor_price" required placeholder="Contoh: 15000" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">
                        </div>
                    </div>

                    <!-- INPUT BAGIAN LINK / BERKAS LIVE -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-600" id="label_input_halaman">Link Video Pembelajaran / Google Drive</label>
                        <div id="wrapper_input_halaman">
                            <input type="text" name="target_data" required placeholder="Masukkan Link Video atau Google Drive materi" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-600">Deskripsi Singkat Pembelajaran</label>
                        <textarea name="tutor_desc" required placeholder="Jelaskan detail singkat isi bimbingan ini..." rows="3" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition resize-none"></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <a href="index.php?page=tutor-dashboard" class="w-1/4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 rounded-xl text-center flex items-center justify-center transition">Batal</a>
                        <button type="submit" class="w-3/4 gradient-blue text-white font-bold py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5">🚀 Up Kursus Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 text-[11px] text-slate-400 border-t bg-white">
        © 2026 BizLogic.co.id
    </footer>

    <!-- JAVASCRIPT LIVE INPUT -->
    <script>
        const metodeSelectHalaman = document.getElementById('metode_select_halaman');
        const labelInputHalaman = document.getElementById('label_input_halaman');
        const wrapperInputHalaman = document.getElementById('wrapper_input_halaman');

        metodeSelectHalaman.addEventListener('change', function() {
            const val = this.value;
            if (val === 'video') {
                labelInputHalaman.innerText = "Link Video Pembelajaran / Google Drive";
                wrapperInputHalaman.innerHTML = `<input type="text" name="target_data" required placeholder="Masukkan Link Video atau Google Drive materi" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">`;
            } else if (val === 'pdf') {
                labelInputHalaman.innerText = "Unggah File Rangkuman (PDF)";
                wrapperInputHalaman.innerHTML = `<input type="file" name="file_pdf" required accept=".pdf" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">`;
            } else if (val === 'online') {
                labelInputHalaman.innerText = "Link Sesi Pertemuan (Zoom / Google Meet)";
                wrapperInputHalaman.innerHTML = `<input type="text" name="target_data" required placeholder="Contoh: https://zoom.us/j/987654321..." class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">`;
            } else if (val === 'offline') {
                labelInputHalaman.innerText = "Tempat & Jam Pertemuan Tatap Muka";
                wrapperInputHalaman.innerHTML = `<input type="text" name="target_data" required placeholder="Contoh: Gedung Baru Ruang 3.2, Jam 14.00 WIB" class="w-full bg-slate-50 border rounded-xl p-3 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition">`;
            }
        });
    </script>

</body>
</html>