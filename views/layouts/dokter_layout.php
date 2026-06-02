<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Dokter' ?> — MediCare Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: { primary: '#2563eb', 'sidebar-bg': '#0f172a', }
                }
            }
        }
    </script>
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-100 flex h-screen overflow-hidden text-slate-800">
    <!-- Sidebar -->
    <aside class="w-64 bg-sidebar-bg text-slate-300 flex flex-col transition-all duration-300 h-full fixed">
        <div class="h-16 flex items-center px-6 border-b border-slate-700/50">
            <h1 class="text-xl font-bold text-white tracking-wide">MediCare Pro</h1>
        </div>
        

        <nav class="flex-1 px-4 mt-6 space-y-1 overflow-y-auto">
            <a href="/clinicv2/dokter/dashboard" class="flex items-center px-4 py-2.5 rounded-lg transition-colors <?= activeMenu('dashboard') ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="/clinicv2/dokter/antrean" class="flex items-center px-4 py-2.5 rounded-lg transition-colors <?= activeMenu('antrean') ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Antrean Pasien
            </a>
            <a href="/clinicv2/dokter/pemeriksaan" class="flex items-center px-4 py-2.5 rounded-lg transition-colors <?= activeMenu('pemeriksaan') ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Pemeriksaan Pasien
            </a>
            <a href="/clinicv2/dokter/resep_obat" class="flex items-center px-4 py-2.5 rounded-lg transition-colors <?= activeMenu('resep_obat') ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Resep Obat
            </a>
            <a href="/clinicv2/dokter/riwayat_pasien" class="flex items-center px-4 py-2.5 rounded-lg transition-colors <?= activeMenu('riwayat_pasien') ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat Pasien
            </a>
        </nav>

        <div class="p-4 mt-auto">
            <div class="bg-slate-800 rounded-xl p-4 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center font-bold text-sm">
                        DR
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-white">Dr. Clinical S.</p>
                        <p class="text-xs text-slate-400">GENERAL PRACTITIONER</p>
                    </div>
                </div>
            </div>
            <a href="/clinicv2/logout" class="mt-4 flex items-center px-4 py-2.5 text-sm text-slate-400 hover:text-white transition-colors rounded-lg hover:bg-slate-800">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 overflow-y-auto">
        <div class="p-8">
            <?= $content ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/clinicv2/assets/js/app.js"></script>
</body>
</html>
