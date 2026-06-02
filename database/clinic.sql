DROP DATABASE IF EXISTS clinic_db;
CREATE DATABASE IF NOT EXISTS clinic_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinic_db;

-- 1. USERS (admin, dokter, owner)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'dokter', 'owner') NOT NULL,
    spesialisasi VARCHAR(100) DEFAULT NULL,  -- untuk dokter
    no_hp VARCHAR(20) DEFAULT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    last_login DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. PASIEN
CREATE TABLE pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_pasien VARCHAR(20) UNIQUE NOT NULL,     -- P-10023
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tanggal_lahir DATE NOT NULL,
    umur INT DEFAULT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    no_ktp VARCHAR(20),
    golongan_darah ENUM('A', 'B', 'AB', 'O') DEFAULT NULL,
    alergi TEXT DEFAULT NULL,
    riwayat_penyakit TEXT DEFAULT NULL,
    tanggal_registrasi DATE NOT NULL DEFAULT (CURDATE()),
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. PEMERIKSAAN AWAL (oleh Admin sebelum ke dokter)
CREATE TABLE pemeriksaan_awal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pasien_id INT NOT NULL,
    tanggal DATE NOT NULL DEFAULT (CURDATE()),
    tekanan_darah VARCHAR(10),          -- 120/80
    gula_darah DECIMAL(5,1) DEFAULT NULL,
    asam_urat DECIMAL(4,1) DEFAULT NULL,
    suhu_tubuh DECIMAL(4,1) DEFAULT NULL,
    berat_badan DECIMAL(5,1) DEFAULT NULL,
    denyut_nadi INT DEFAULT NULL,
    keluhan TEXT,
    catatan TEXT DEFAULT NULL,
    petugas_id INT NOT NULL,            -- admin yg melakukan
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pasien_id) REFERENCES pasien(id) ON DELETE CASCADE,
    FOREIGN KEY (petugas_id) REFERENCES users(id)
);

-- 4. ANTREAN
CREATE TABLE antrean (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_antrean VARCHAR(10) NOT NULL,      -- A-045
    pasien_id INT NOT NULL,
    tanggal DATE NOT NULL DEFAULT (CURDATE()),
    waktu_daftar DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    layanan VARCHAR(50) NOT NULL DEFAULT 'Poli Umum',  -- Poli Umum, Poli Gigi, dll
    dokter_id INT DEFAULT NULL,
    pemeriksaan_awal_id INT DEFAULT NULL,
    status ENUM('menunggu', 'dipanggil', 'diperiksa', 'selesai', 'terlewati', 'batal') DEFAULT 'menunggu',
    prioritas ENUM('normal', 'urgent', 'darurat') DEFAULT 'normal',
    waktu_dipanggil DATETIME DEFAULT NULL,
    waktu_selesai DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pasien_id) REFERENCES pasien(id) ON DELETE CASCADE,
    FOREIGN KEY (dokter_id) REFERENCES users(id),
    FOREIGN KEY (pemeriksaan_awal_id) REFERENCES pemeriksaan_awal(id)
);

-- 5. PEMERIKSAAN (oleh Dokter)
CREATE TABLE pemeriksaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_pemeriksaan VARCHAR(20) UNIQUE NOT NULL,  -- PX-2023-0891
    pasien_id INT NOT NULL,
    dokter_id INT NOT NULL,
    antrean_id INT DEFAULT NULL,
    tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    -- SOAP Method
    subjective TEXT,               -- keluhan utama
    objective TEXT,                 -- hasil pemeriksaan fisik
    assessment TEXT,               -- diagnosis (kode ICD-10)
    plan TEXT,                     -- tindakan medis
    catatan_klinis TEXT DEFAULT NULL,
    jenis_rawat ENUM('Rawat Jalan', 'Rawat Inap') DEFAULT 'Rawat Jalan',
    biaya_pemeriksaan DECIMAL(12,0) DEFAULT 0,
    biaya_tindakan DECIMAL(12,0) DEFAULT 0,
    status ENUM('proses', 'selesai') DEFAULT 'proses',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pasien_id) REFERENCES pasien(id) ON DELETE CASCADE,
    FOREIGN KEY (dokter_id) REFERENCES users(id),
    FOREIGN KEY (antrean_id) REFERENCES antrean(id)
);

-- 6. OBAT
CREATE TABLE obat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_obat VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,           -- Antibiotik, Analgesik, Vitamin, dll
    bentuk_sediaan VARCHAR(50),              -- Tablet, Kapsul, Syrup, dll
    satuan VARCHAR(20) NOT NULL,             -- Box, Tablet, Botol
    harga_satuan DECIMAL(12,0) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    stok_minimum INT DEFAULT 10,
    keterangan TEXT DEFAULT NULL,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 7. RESEP OBAT
CREATE TABLE resep_obat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pemeriksaan_id INT NOT NULL,
    obat_id INT NOT NULL,
    jumlah INT NOT NULL,
    aturan_pakai VARCHAR(100),              -- "3x1 Sesudah Makan"
    catatan TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pemeriksaan_id) REFERENCES pemeriksaan(id) ON DELETE CASCADE,
    FOREIGN KEY (obat_id) REFERENCES obat(id)
);

-- 8. PEMBAYARAN
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_transaksi VARCHAR(30) UNIQUE NOT NULL,   -- TR-2023-001
    pemeriksaan_id INT NOT NULL,
    pasien_id INT NOT NULL,
    tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    biaya_pemeriksaan DECIMAL(12,0) DEFAULT 0,
    biaya_obat DECIMAL(12,0) DEFAULT 0,
    biaya_tindakan DECIMAL(12,0) DEFAULT 0,
    total DECIMAL(12,0) NOT NULL DEFAULT 0,
    metode_pembayaran ENUM('Tunai', 'QRIS', 'Transfer Bank', 'Debit Card', 'Asuransi/BPJS') NOT NULL,
    status ENUM('pending', 'success', 'gagal') DEFAULT 'pending',
    catatan TEXT DEFAULT NULL,
    petugas_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pemeriksaan_id) REFERENCES pemeriksaan(id),
    FOREIGN KEY (pasien_id) REFERENCES pasien(id),
    FOREIGN KEY (petugas_id) REFERENCES users(id)
);

-- 9. RUJUKAN
CREATE TABLE rujukan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_rujukan VARCHAR(20) UNIQUE NOT NULL,    -- REF-2023-0801
    pasien_id INT NOT NULL,
    pemeriksaan_id INT DEFAULT NULL,
    rumah_sakit_tujuan VARCHAR(100) NOT NULL,
    tanggal_rujukan DATE NOT NULL DEFAULT (CURDATE()),
    diagnosis_sementara TEXT,
    alasan_rujukan TEXT,
    dokter_perujuk_id INT DEFAULT NULL,
    status ENUM('dikirim', 'selesai', 'dibatalkan') DEFAULT 'dikirim',
    catatan TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pasien_id) REFERENCES pasien(id) ON DELETE CASCADE,
    FOREIGN KEY (pemeriksaan_id) REFERENCES pemeriksaan(id),
    FOREIGN KEY (dokter_perujuk_id) REFERENCES users(id)
);

-- 10. STOK OBAT LOG
CREATE TABLE stok_obat_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    obat_id INT NOT NULL,
    tipe ENUM('masuk', 'keluar') NOT NULL,
    jumlah INT NOT NULL,
    keterangan TEXT,
    pengguna_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (obat_id) REFERENCES obat(id),
    FOREIGN KEY (pengguna_id) REFERENCES users(id)
);

-- 11. BACKUP LOG
CREATE TABLE backup_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_file VARCHAR(255) NOT NULL,
    ukuran VARCHAR(20),
    status ENUM('success', 'failed') DEFAULT 'success',
    catatan TEXT DEFAULT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 12. AUDIT LOG (tambahan untuk fitur owner)
CREATE TABLE audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    kategori VARCHAR(50) NOT NULL,      -- LOGIN, STOCK, UPDATE, TRANSACTION, SECURITY, DELETE
    aktivitas TEXT NOT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ===========================
-- SEED DATA (Data Dummy)
-- ===========================

-- Users
INSERT INTO users (nama, email, username, password, role, spesialisasi) VALUES
('Admin Utama', 'admin@klinik.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL),
('Dr. Clinical Smith', 'dokter@klinik.com', 'dokter', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dokter', 'General Practitioner'),
('Dr. Hendra Wijaya', 'owner@klinik.com', 'owner', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'owner', NULL);
-- Password semua: "password"

-- Pasien (minimal 10 data)
INSERT INTO pasien (kode_pasien, nama, jenis_kelamin, tanggal_lahir, alamat, no_hp, tanggal_registrasi) VALUES
('P-10023', 'Budi Santoso', 'Laki-laki', '1978-05-12', 'Jl. Merdeka No. 12, Jakarta Pusat', '0812-3456-7890', '2023-10-12'),
('P-10045', 'Siti Aminah', 'Perempuan', '1995-08-23', 'Komp. Melati Blok C-4, Bandung', '0821-9988-7766', '2023-10-15'),
('P-10088', 'Andi Darmawan', 'Laki-laki', '1989-03-17', 'Jl. Sudirman No. 88, Surabaya', '0852-1122-3344', '2023-10-18'),
('P-10112', 'Rina Kusuma', 'Perempuan', '1992-11-05', 'Jl. Gatot Subroto No. 5, Jakarta', '0813-5566-7788', '2023-10-20'),
('P-10130', 'Ahmad Subarjo', 'Laki-laki', '1985-01-30', 'Jl. Diponegoro No. 42, Semarang', '0856-7788-9900', '2023-10-22'),
('P-10155', 'Dewi Puspita', 'Perempuan', '1990-07-14', 'Jl. Asia Afrika No. 15, Bandung', '0878-1234-5678', '2023-10-25'),
('P-10178', 'Rizky Setiawan', 'Laki-laki', '1994-09-29', 'Jl. Thamrin No. 33, Jakarta', '0819-8877-6655', '2023-10-28'),
('P-10200', 'Joko Widodo', 'Laki-laki', '1975-06-21', 'Jl. Pemuda No. 10, Yogyakarta', '0812-9988-1122', '2023-11-01'),
('P-10225', 'Liem Swie King', 'Laki-laki', '1980-02-28', 'Jl. Hayam Wuruk No. 8, Jakarta', '0821-3344-5566', '2023-11-05'),
('P-10250', 'Rudi Kurniawan', 'Laki-laki', '1988-12-03', 'Jl. Veteran No. 22, Malang', '0857-6677-8899', '2023-11-10');

-- Obat (minimal 10 data)
INSERT INTO obat (nama_obat, kategori, bentuk_sediaan, satuan, harga_satuan, stok, stok_minimum) VALUES
('Amoxicillin 500mg', 'Antibiotik', 'Kapsul', 'Box', 12500, 850, 100),
('Paracetamol 500mg', 'Analgesik', 'Tablet', 'Box', 8000, 42, 50),
('Paracetamol Syrup', 'Analgesik', 'Syrup', 'Botol', 24000, 8, 10),
('Atorvastatin 20mg', 'Kolesterol', 'Tablet', 'Box', 45800, 12, 20),
('Vitamin C 1000mg', 'Suplemen', 'Tablet', 'Box', 8000, 1900, 100),
('Cetirizine 10mg', 'Antihistamin', 'Tablet', 'Box', 6500, 320, 50),
('Ibuprofen 400mg', 'Analgesik', 'Tablet', 'Box', 9500, 512, 50),
('Amoxicillin 250mg', 'Antibiotik', 'Kapsul', 'Box', 10000, 840, 100),
('Lansoprazole 30mg', 'Gastrointestinal', 'Kapsul', 'Box', 15000, 200, 30),
('Metformin 500mg', 'Antidiabetes', 'Tablet', 'Box', 7500, 30, 50),
('Amlodipine 5mg', 'Antihipertensi', 'Tablet', 'Box', 12000, 150, 30);

-- Tambahkan data dummy pemeriksaan_awal, antrean, pemeriksaan, pembayaran, dll
-- (Cukup 5-8 record per tabel untuk testing)

INSERT INTO pemeriksaan_awal (pasien_id, tanggal, tekanan_darah, gula_darah, asam_urat, suhu_tubuh, berat_badan, denyut_nadi, keluhan, petugas_id) VALUES
(1, CURDATE(), '120/80', 110, 5.2, 36.5, 70, 80, 'Demam dan batuk 3 hari', 1),
(2, CURDATE(), '135/90', 145, 6.8, 37.2, 55, 88, 'Pusing dan mual 2 hari', 1),
(3, CURDATE(), '115/75', 98, 4.5, 36.8, 65, 72, 'Nyeri punggung bawah', 1),
(7, CURDATE(), '120/80', 100, 5.4, 36.5, 70, 80, 'Kontrol rutin', 1);

INSERT INTO antrean (nomor_antrean, pasien_id, tanggal, layanan, dokter_id, pemeriksaan_awal_id, status) VALUES
('A-017', 7, CURDATE(), 'Poli Umum', 2, 4, 'menunggu'),
('A-018', 2, CURDATE(), 'Poli Umum', 2, 2, 'diperiksa'),
('A-019', 3, CURDATE(), 'Poli Umum', 2, 3, 'menunggu'),
('A-020', 1, CURDATE(), 'Poli Umum', 2, 1, 'menunggu'),
('A-042', 1, CURDATE(), 'Poli Umum', 2, 1, 'diperiksa'),
('A-041', 2, CURDATE(), 'Poli Gigi', 2, 2, 'menunggu'),
('A-043', 3, CURDATE(), 'Cek Darah', 2, 3, 'selesai');

INSERT INTO pemeriksaan (kode_pemeriksaan, pasien_id, dokter_id, antrean_id, subjective, objective, assessment, plan, biaya_pemeriksaan, biaya_tindakan, status) VALUES
('PX-2023-0891', 7, 2, 1, 'Keluhan batuk berdahak', 'Ronki pada paru kanan', 'ISPA Ringan', 'Pemberian Nebulizer', 150000, 50000, 'selesai'),
('PX-2023-0892', 1, 2, 5, 'Demam tinggi 3 hari', 'Suhu 38.5C, tenggorokan merah', 'Faringitis Akut', 'Istirahat, minum obat', 150000, 0, 'selesai');

INSERT INTO resep_obat (pemeriksaan_id, obat_id, jumlah, aturan_pakai) VALUES
(1, 2, 10, '3x1 Sesudah Makan'),
(1, 8, 15, '3x1 Habiskan'),
(1, 6, 5, '1x1 Malam Hari'),
(2, 1, 10, '3x1 Sesudah Makan'),
(2, 2, 10, '3x1 Jika Demam');

INSERT INTO pembayaran (kode_transaksi, pemeriksaan_id, pasien_id, biaya_pemeriksaan, biaya_obat, biaya_tindakan, total, metode_pembayaran, status, petugas_id) VALUES
('TR-2023-001', 1, 7, 150000, 155000, 50000, 355000, 'QRIS', 'success', 1),
('TR-2023-002', 2, 1, 150000, 205000, 0, 355000, 'Tunai', 'success', 1);

INSERT INTO rujukan (nomor_rujukan, pasien_id, pemeriksaan_id, rumah_sakit_tujuan, tanggal_rujukan, diagnosis_sementara, alasan_rujukan, dokter_perujuk_id, status) VALUES
('REF-2023-0801', 5, NULL, 'RS Dr. Cipto', '2023-08-12', 'Suspek Appendicitis', 'Memerlukan pemeriksaan lanjutan USG', 2, 'dikirim'),
('REF-2023-0795', 2, NULL, 'RS Medistra', '2023-08-10', 'Vertigo Berat', 'Perlu MRI kepala', 2, 'selesai');

INSERT INTO stok_obat_log (obat_id, tipe, jumlah, keterangan, pengguna_id) VALUES
(2, 'masuk', 500, 'Restock dari Supplier Utama', 1),
(8, 'keluar', 15, 'Resep dr. Sarah (INV-0921)', 2),
(6, 'keluar', 10, 'Kadaluwarsa (Pemusnahan)', 1),
(9, 'masuk', 200, 'Inventarisasi Awal Bulan', 1),
(11, 'keluar', 30, 'Resep dr. Iwan (INV-0925)', 2);

INSERT INTO backup_log (nama_file, ukuran, status, user_id) VALUES
('MED_BACKUP_20231024_0300.sql', '1.2 GB', 'success', 3),
('MED_BACKUP_20231023_0300.sql', '1.18 GB', 'success', 3),
('MED_BACKUP_20231022_0300.sql', '0.0 GB', 'failed', 3),
('MED_BACKUP_20231021_0300.sql', '1.15 GB', 'success', 3);

INSERT INTO audit_log (user_id, kategori, aktivitas, ip_address) VALUES
(1, 'STOCK', 'Update Stok Paracetamol (Box 50)', '192.168.1.50'),
(2, 'LOGIN', 'Login Berhasil', '192.168.1.102'),
(3, 'SECURITY', 'Hapus Data Pasien #P-10928', '192.168.1.50'),
(1, 'UPDATE', 'Update Pengaturan Klinik (Jam Operasional)', '202.10.45.1'),
(1, 'TRANSACTION', 'Input Pembayaran Resep #INV-8872', '192.168.1.55');
