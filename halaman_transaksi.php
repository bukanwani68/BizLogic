<?php
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$course_id = intval($_GET['id']);

// Ambil detail materi yang dibeli
$query = mysqli_query($conn, "SELECT * FROM `courses` WHERE `id` = '$course_id'");
$course = mysqli_fetch_assoc($query);

if (!$course) {
    echo "Materi tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - BizLogic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; }
        .gradient-blue { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full flex flex-col gap-5">
        
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                <div>
                    <span class="text-[10px] bg-emerald-50 text-emerald-700 font-bold px-2 py-1 rounded-md tracking-wide">✓ PEMBAYARAN BERHASIL</span>
                    <h2 class="text-sm font-bold text-slate-800 mt-2">Nota Transaksi</h2>
                </div>
                <div class="text-right text-[10px] text-slate-400 font-mono pt-1">
                    <p>INV/<?= date('Ymd') ?>/<?= $course['id'] ?></p>
                </div>
            </div>
            
            <div class="space-y-2.5 text-xs">
                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Mata Kuliah</span> 
                    <span class="font-semibold text-slate-700 text-right"><?= htmlspecialchars($course['nama_matkul']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Metode</span> 
                    <span class="font-semibold text-slate-700 uppercase tracking-wider"><?= htmlspecialchars($course['metode']) ?></span>
                </div>
                <div class="flex justify-between border-t border-slate-100 pt-2.5 mt-1">
                    <span class="text-slate-600 font-bold">Total Bayar</span> 
                    <span class="font-bold text-blue-600 text-sm">Rp <?= number_format($course['harga'], 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 sm:p-8 text-center space-y-5 border border-slate-200/80 shadow-md relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-emerald-500"></div>

            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-xl shadow-inner border border-emerald-100/50">
                🔐
            </div>
            
            <div class="space-y-1">
                <h3 class="text-sm font-bold text-slate-900 tracking-tight">Escrow Lock Diaktifkan</h3>
                <p class="text-xs text-slate-400">Materi: <span class="text-blue-600 font-semibold"><?= htmlspecialchars($course['topik']) ?></span></p>
            </div>

            <div class="bg-slate-50 border border-dashed border-slate-200 rounded-xl p-4 text-xs transition hover:bg-slate-100/50">
                <p class="text-[11px] text-slate-400 mb-2 font-medium">Tujuan Akses Materi / Berkas:</p>
                
                <?php 
                // Cek ekstensi file target_data apakah berakhiran .pdf
                $is_pdf = (substr(strtolower($course['target_data']), -4) === '.pdf');
                
                if ($course['metode'] === 'pdf' || $is_pdf): 
                    $folder_simpan = "uploads/"; // Sesuaikan nama folder penyimpanan berkas tutor kamu
                ?>
                    <a href="<?= $folder_simpan . htmlspecialchars($course['target_data']) ?>" target="_blank" class="text-blue-600 font-bold underline hover:text-blue-800 break-all flex items-center justify-center gap-1.5 p-1 bg-white border rounded-lg shadow-sm hover:border-blue-300 transition">
                        📄 Buka Berkas PDF
                    </a>
                <?php elseif (filter_var($course['target_data'], FILTER_VALIDATE_URL)): ?>
                    <a href="<?= $course['target_data'] ?>" target="_blank" class="text-blue-600 font-bold underline hover:text-blue-800 break-all flex items-center justify-center gap-1">
                        🔗 Buka Link Pembelajaran
                    </a>
                <?php else: ?>
                    <span class="text-slate-800 font-bold block bg-white p-2 rounded-lg border"><?= htmlspecialchars($course['target_data']) ?></span>
                <?php endif; ?>
            </div>

            <p class="text-[10px] text-slate-400 leading-relaxed px-1">
                Dana Anda aman di dalam sistem jaminan BizLogic. Silakan periksa berkas materi di atas sebelum bimbingan selesai dilakukan.
            </p>

            <a href="index.php?page=home" class="block w-full bg-slate-950 hover:bg-slate-800 text-white text-xs font-bold py-3.5 rounded-xl transition shadow-md">
                Selesai & Kembali ke Beranda
            </a>
        </div>
        
    </div>

</body>
</html>