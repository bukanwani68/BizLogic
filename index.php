<?php
include 'koneksi.php';

// Proteksi Halaman: Jika belum login, kembalikan ke login.php
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil data user aktif dari session
$user_id       = $_SESSION['user_id'];
$username      = $_SESSION['username'];
$nama_lengkap  = $_SESSION['nama_lengkap'];
$universitas   = $_SESSION['universitas'];
$prodi         = $_SESSION['prodi'];
$kelas         = $_SESSION['kelas'];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizLogic.co.id - Teman Belajar Pintar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .gradient-blue { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
    </style>
</head>
<body class="text-slate-800">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php?page=home" class="flex items-center gap-2">
                <div class="w-9 h-9 gradient-blue rounded-xl flex items-center justify-center text-white font-bold text-lg">B</div>
                <span class="text-xl font-bold tracking-tight text-blue-900">Biz<span class="text-blue-500">Logic</span></span>
            </a>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="index.php?page=home" class="hover:text-blue-600 transition <?= $page == 'home' ? 'text-blue-600 font-semibold' : '' ?>">Beranda</a>
                <span class="text-slate-200">|</span>
                
                <?php if (strtolower($username) === 'almeira') : ?>
                    <a href="index.php?page=tutor-dashboard" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">👨‍🏫 Dashboard Tutor</a>
                <?php endif; ?>
                
                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold"><?= $kelas . " - " . $prodi ?></span>
                <a href="logout.php" class="text-red-500 hover:text-red-700 font-bold text-xs">Keluar ↩</a>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-900"><?= $nama_lengkap ?></p>
                    <p class="text-[10px] text-slate-400"><?= $universitas ?></p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-blue-500/20 flex items-center justify-center bg-slate-200 text-blue-900 font-bold uppercase">
                    <?= substr($username, 0, 1) ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if ($page === 'home') : ?>
        <header class="gradient-blue text-white px-6 pt-16 pb-24 text-center space-y-4">
            <h1 class="text-3xl sm:text-5xl font-bold tracking-tight">Teman Belajar Pintar, Bukan Guru Menggurui</h1>
            <p class="text-sm text-blue-100 max-w-2xl mx-auto font-light">Cari bimbingan adaptif yang 100% klop dengan silabus dosen kampusmu.</p>
        </header>

        <section class="max-w-5xl mx-auto -mt-12 px-6">
            <form action="index.php" method="GET" class="bg-white p-5 rounded-2xl shadow-xl border border-slate-100">
                <input type="hidden" name="page" value="home">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div class="space-y-1.5 text-xs">
                        <label class="font-bold text-slate-400 uppercase block">1. Universitas</label>
                        <select class="w-full bg-slate-50 border rounded-xl p-3 font-semibold text-slate-700"><option><?= $universitas ?></option></select>
                    </div>
                    <div class="space-y-1.5 text-xs">
                        <label class="font-bold text-slate-400 uppercase block">2. Program Studi</label>
                        <select class="w-full bg-slate-50 border rounded-xl p-3 font-semibold text-slate-700"><option><?= $prodi ?></option></select>
                    </div>
                    <div class="space-y-1.5 text-xs">
                        <label class="font-bold text-slate-400 uppercase block">3. Metode Belajar</label>
                        <select name="filter_metode" class="w-full bg-slate-50 border rounded-xl p-3 font-semibold text-slate-700">
                            <option value="all">Semua Tipe Metode</option>
                            <option value="video" <?= isset($_GET['filter_metode']) && $_GET['filter_metode']=='video'?'selected':'' ?>>📺 Video Belajar</option>
                            <option value="pdf" <?= isset($_GET['filter_metode']) && $_GET['filter_metode']=='pdf'?'selected':'' ?>>📄 Summary PDF</option>
                            <option value="online" <?= isset($_GET['filter_metode']) && $_GET['filter_metode']=='online'?'selected':'' ?>>💻 Sesi Online</option>
                            <option value="offline" <?= isset($_GET['filter_metode']) && $_GET['filter_metode']=='offline'?'selected':'' ?>>🤝 Sesi Offline</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full gradient-blue text-white font-bold text-sm py-3.5 rounded-xl shadow-md">🔍 Cari Solusi</button>
                </div>
            </form>
        </section>

        <section class="max-w-6xl mx-auto px-6 pt-12 space-y-6">
            <div class="flex justify-between items-center text-xs">
                <h2 class="text-xl font-bold text-slate-900">Solusi Terlaris di Kampusmu</h2>
                <span class="bg-emerald-50 text-emerald-700 font-bold px-2 py-1 rounded">✨ IPK-mu &gt; 3.8</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $kondisi_metode = "";
                if (isset($_GET['filter_metode']) && $_GET['filter_metode'] !== 'all') {
                    $metode = mysqli_real_escape_string($conn, $_GET['filter_metode']);
                    $kondisi_metode = " WHERE c.metode = '$metode' ";
                }

                $query = "SELECT c.*, u.nama_lengkap, u.username FROM `courses` c JOIN `users` u ON c.user_id = u.id $kondisi_metode ORDER BY c.id DESC";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="bg-white rounded-2xl border p-5 shadow-sm flex flex-col justify-between">
                            <div class="space-y-3">
                                <span class="text-[10px] font-bold px-2 py-1 bg-blue-50 text-blue-600 rounded uppercase tracking-wide"><?= $row['metode'] ?></span>
                                <h3 class="font-bold text-slate-900 text-base"><?= htmlspecialchars($row['topik']) ?></h3>
                                <p class="text-xs text-slate-400 font-medium"><?= htmlspecialchars($row['nama_matkul']) ?> • <?= $row['week'] ?></p>
                                <p class="text-xs text-slate-500 font-light"><?= htmlspecialchars($row['deskripsi']) ?></p>
                            </div>
                            <div class="pt-4 border-t mt-4 flex justify-between items-center text-xs">
                                <div>
                                    <p class="text-[10px] text-slate-400">Tutor: <b><?= htmlspecialchars($row['nama_lengkap']) ?></b></p>
                                    <p class="font-bold text-blue-900">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                                </div>
                                <a href="proses_beli.php?id=<?= $row['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition">
                                    🛒 Beli Solusi
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='col-span-3 text-center text-slate-400 text-xs py-8'>Belum ada materi kursus yang cocok.</p>";
                }
                ?>
            </div>
        </section>

    <?php elseif ($page === 'tutor-dashboard' && strtolower($username) === 'almeira') : ?>
        <main class="max-w-5xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border p-6 shadow-sm space-y-4 text-center text-xs align-top h-fit">
                <div class="w-14 h-14 bg-blue-600 text-white rounded-full mx-auto flex items-center justify-center font-bold text-lg">AL</div>
                <h3 class="font-bold text-base text-slate-900"><?= $nama_lengkap ?></h3>
                <p class="text-amber-600 font-bold">🎖️ Certified Peer-Tutor</p>
                <div class="border-t pt-4 space-y-2 text-left">
                    <div class="flex justify-between"> <span class="text-slate-400">Total Siswa</span> <span class="font-bold">171 Mhs</span> </div>
                    <div class="flex justify-between"> <span class="text-slate-400">Rating</span> <span class="font-bold">⭐ 4.95</span> </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border p-8 shadow-sm text-center space-y-4">
                    <div class="max-w-sm mx-auto space-y-1.5">
                        <span class="text-3xl">📚</span>
                        <h2 class="text-sm font-bold text-slate-900">Ingin Merilis Solusi Belajar Baru?</h2>
                        <p class="text-xs text-slate-400">Buat rangkuman materi PDF baru, unggah video pembelajaran, atau jadwalkan pertemuan bimbingan kelompokmu di sini.</p>
                    </div>
                    <a href="tambah_course.php" class="inline-block gradient-blue text-white text-xs font-bold px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                        ➕ Mulai Tambah Course Baru
                    </a>
                </div>

                <div class="bg-white rounded-2xl border p-6 shadow-sm space-y-3">
                    <h2 class="text-sm font-bold text-slate-900 border-b pb-2">📦 Riwayat Solusi yang Kamu Up</h2>
                    <div class="space-y-2 max-h-60 overflow-y-auto text-xs">
                        <?php
                        $query_my = "SELECT * FROM `courses` WHERE `user_id` = '$user_id' ORDER BY id DESC";
                        $res_my = mysqli_query($conn, $query_my);
                        if (mysqli_num_rows($res_my) > 0) {
                            while ($my = mysqli_fetch_assoc($res_my)) {
                                echo "<div class='p-3 bg-slate-50 border rounded-xl flex justify-between items-center'>";
                                echo "<div><p class='font-bold text-slate-800'>{$my['topik']}</p><p class='text-[10px] text-slate-400'>{$my['nama_matkul']} ({$my['metode']})</p></div>";
                                echo "<span class='font-bold text-blue-700'>Rp ".number_format($my['harga'],0,',','.')."</span>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='text-center text-slate-400 py-4 font-light'>Kamu belum meng-up materi kursus apapun.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    <?php endif; ?>

    <div id="booking-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 text-center space-y-4 shadow-2xl text-xs">
            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 text-xl flex items-center justify-center mx-auto">🔒</div>
            <h3 class="font-bold text-base text-slate-900">Escrow Lock Diaktifkan</h3>
            <p class="text-slate-500">Materi: <span id="modal-item-name" class="font-semibold text-blue-600"></span></p>
            <p id="modal-target" class="bg-slate-50 p-2 rounded border border-dashed font-mono text-slate-600 overflow-x-auto text-[10px]"></p>
            <button onclick="closeModal()" class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl">Selesai</button>
        </div>
    </div>

    <script>
        function openBookingSuccess(itemName, targetData) {
            document.getElementById('modal-item-name').innerText = itemName;
            document.getElementById('modal-target').innerText = "Tujuan: " + targetData;
            document.getElementById('booking-modal').classList.replace('hidden', 'flex');
        }
        function closeModal() {
            document.getElementById('booking-modal').classList.replace('flex', 'hidden');
        }
    </script>

    <?php 
        // Jika ada parameter bought_id di URL, ambil datanya untuk ditampilkan di Modal Escrow
        if (isset($_GET['bought_id'])) {
            $bought_id = intval($_GET['bought_id']);
            $query_modal = mysqli_query($conn, "SELECT * FROM `courses` WHERE `id` = '$bought_id'");
            if ($course_data = mysqli_fetch_assoc($query_modal)) {
        ?>
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-2xl p-6 sm:p-8 max-w-md w-full text-center space-y-6 shadow-2xl transform transition scale-100 animate-fade-in">
                    <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto text-2xl">
                        🔒
                    </div>
                    
                    <div class="space-y-1">
                        <h3 class="text-base font-bold text-slate-900">Escrow Lock Diaktifkan</h3>
                        <p class="text-xs text-slate-400">Materi: <span class="text-blue-600 font-semibold"><?= htmlspecialchars($course_data['topik']) ?></span></p>
                    </div>

                    <div class="bg-slate-50 border border-dashed rounded-xl p-4 text-xs">
                        <p class="text-slate-400 mb-1 font-medium">Tujuan Akses Materi:</p>
                        <?php if (filter_var($course_data['target_data'], FILTER_VALIDATE_URL)): ?>
                            <a href="<?= $course_data['target_data'] ?>" target="_blank" class="text-blue-600 font-bold underline hover:text-blue-800 break-all">
                                🔗 Klik Disini Untuk Membuka Link
                            </a>
                        <?php else: ?>
                            <span class="text-slate-800 font-bold break-all"><?= htmlspecialchars($course_data['target_data']) ?></span>
                        <?php endif; ?>
                    </div>

                    <a href="index.php?page=home" class="block w-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold py-3.5 rounded-xl transition shadow-md">
                        Selesai
                    </a>
                </div>
            </div>
        <?php 
            }
        } 
        ?>

    <footer class="mt-20 bg-white border-t border-slate-100">
        <div class="max-w-5xl mx-auto px-6 py-10 space-y-8">
            
            <div class="gradient-blue rounded-2xl p-6 sm:p-8 text-white flex flex-col sm:flex-row justify-between items-center gap-4 shadow-md transform transition hover:scale-[1.01]">
                <div class="space-y-1 text-center sm:text-left">
                    <h3 class="text-base font-bold tracking-tight">Bagikan Ilmumu & Raih Penghasilan Tambahan! 🚀</h3>
                    <p class="text-xs text-blue-100 max-w-xl">Punya keahlian di mata kuliah tertentu? Gabung menjadi Peer-Tutor di BizLogic dan bantu mahasiswa lain meraih nilai impian mereka.</p>
                </div>
                <a href="daftar_tutor.php" class="bg-white text-blue-900 hover:bg-blue-50 text-xs font-bold px-5 py-3 rounded-xl shadow-sm transition whitespace-nowrap">
                    🤝 Daftar Jadi Tutor Sekarang
                </a>
            </div>

            <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-[11px] text-slate-400">
                <p>© 2026 BizLogic.co.id. All rights reserved.</p>
                
                <div class="flex gap-4">
                    <a href="#" class="hover:text-slate-600">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-slate-600">Kebijakan Privasi</a>
                </div>
            </div>

        </div>
    </footer>
</body>
</html>