<div class="mb-6 flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang, Admin</h2>
        <p class="text-slate-500 mt-1"><?= formatTanggal(date('Y-m-d')) ?></p>
    </div>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase">Total Pasien</p>
            <div class="flex items-baseline mt-1">
                <h3 class="text-2xl font-bold text-slate-800"><?= number_format($totalPasien ?? 0) ?></h3>
                <span class="ml-2 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+12%</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase">Antrean Hari Ini</p>
            <div class="flex items-baseline mt-1">
                <h3 class="text-2xl font-bold text-slate-800">42</h3>
                <span class="ml-2 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">8 Pending</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase">Sedang Diperiksa</p>
            <div class="flex items-baseline mt-1">
                <h3 class="text-2xl font-bold text-slate-800">5</h3>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase">Transaksi Selesai</p>
            <div class="flex items-baseline mt-1">
                <h3 class="text-2xl font-bold text-slate-800">28</h3>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-4">Grafik Aktivitas Pasien Harian</h3>
        <div class="h-64 relative">
            <!-- Chart Placeholder -->
            <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-50 rounded border border-dashed border-slate-200">
                Chart.js Bar Chart (7 Hari Terakhir)
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-4">Distribusi Layanan</h3>
        <div class="h-64 relative">
            <!-- Chart Placeholder -->
            <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-50 rounded border border-dashed border-slate-200">
                Chart.js Doughnut Chart
            </div>
        </div>
    </div>
</div>

<!-- Recent Queue Table -->
<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Antrean Pasien Terbaru</h3>
        <a href="/clinicv2/admin/antrean" class="px-3 py-1.5 text-sm bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors">
            Tambah Pendaftaran Baru
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-500">
                <tr>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">No. Antrean</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Layanan</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-800">A-042</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">BM</div>
                            <span>Budi Mansyur</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Poli Umum</td>
                    <td class="px-6 py-4 text-slate-500">09:15 WIB</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">MENUNGGU</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-primary hover:text-blue-800 font-medium text-sm">Panggil</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
