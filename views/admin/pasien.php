<div class="mb-6 flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Data Pasien</h2>
        <p class="text-slate-500 mt-1">Kelola informasi pasien dan riwayat medis secara terpusat.</p>
    </div>
    <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center shadow-sm shadow-blue-500/20">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Pasien Baru
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden mb-8">
    <div class="p-4 border-b border-slate-100 flex justify-between items-center gap-4 bg-slate-50/50">
        <div class="relative flex-1 max-w-md">
            <input type="text" placeholder="Cari ID Pasien, Nama..." class="w-full bg-white text-sm text-slate-800 placeholder-slate-400 rounded-lg pl-10 pr-4 py-2 border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
            <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <select class="bg-white text-sm text-slate-700 rounded-lg px-4 py-2 border border-slate-200 focus:ring-2 focus:ring-primary outline-none cursor-pointer">
            <option value="">Semua Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-500">
                <tr>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Umur</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Nomor HP</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider">Tanggal Registrasi</th>
                    <th class="px-6 py-3 font-medium text-xs uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if (!empty($pasienList)): ?>
                    <?php foreach ($pasienList as $p): ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3 shrink-0">
                                    <?= substr($p['nama'], 0, 2) ?>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800"><?= htmlspecialchars($p['nama']) ?></p>
                                    <p class="text-xs text-slate-500"><?= htmlspecialchars($p['kode_pasien']) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($p['jenis_kelamin']) ?></td>
                        <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($p['umur'] ?? date_diff(date_create($p['tanggal_lahir']), date_create('today'))->y) ?> Tahun</td>
                        <td class="px-6 py-4 text-slate-500 truncate max-w-xs" title="<?= htmlspecialchars($p['alamat']) ?>"><?= htmlspecialchars($p['alamat']) ?></td>
                        <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($p['no_hp']) ?></td>
                        <td class="px-6 py-4 text-slate-500"><?= formatTanggal($p['tanggal_registrasi']) ?></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button class="text-slate-400 hover:text-blue-600 transition-colors" title="Edit">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <button class="text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">Belum ada data pasien.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-slate-50/50">
        <p class="text-sm text-slate-500">
            Menampilkan <span class="font-medium text-slate-700"><?= isset($offset) ? $offset + 1 : 1 ?></span> - <span class="font-medium text-slate-700"><?= min(($offset ?? 0) + ($limit ?? 10), $totalPasien ?? 0) ?></span> dari <span class="font-medium text-slate-700"><?= $totalPasien ?? 0 ?></span> pasien
        </p>
        <div class="flex space-x-1">
            <button class="px-3 py-1 rounded border border-slate-200 bg-white text-slate-500 hover:bg-slate-50" <?= ($page ?? 1) <= 1 ? 'disabled' : '' ?>>Sebelumnya</button>
            <?php for ($i = 1; $i <= ($totalPages ?? 1); $i++): ?>
                <button class="px-3 py-1 rounded <?= ($page ?? 1) == $i ? 'bg-primary text-white' : 'border border-slate-200 bg-white text-slate-700 hover:bg-slate-50' ?>"><?= $i ?></button>
            <?php endfor; ?>
            <button class="px-3 py-1 rounded border border-slate-200 bg-white text-slate-500 hover:bg-slate-50" <?= ($page ?? 1) >= ($totalPages ?? 1) ? 'disabled' : '' ?>>Selanjutnya</button>
        </div>
    </div>
</div>
