<?php
class DokterController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        header('Location: /clinicv2/dokter/dashboard');
        exit;
    }

    public function dashboard() {
        $pageTitle = 'Dashboard Dokter';
        ob_start();
        include 'views/dokter/dashboard.php';
        $content = ob_get_clean();
        include 'views/layouts/dokter_layout.php';
    }

    public function antrean() {
        $pageTitle = 'Antrean Pasien';
        ob_start(); include 'views/dokter/antrean.php'; $content = ob_get_clean();
        include 'views/layouts/dokter_layout.php';
    }

    public function pemeriksaan() {
        $pageTitle = 'Pemeriksaan Pasien';
        ob_start(); include 'views/dokter/pemeriksaan.php'; $content = ob_get_clean();
        include 'views/layouts/dokter_layout.php';
    }

    public function resep_obat() {
        $pageTitle = 'Resep Obat';
        ob_start(); include 'views/dokter/resep_obat.php'; $content = ob_get_clean();
        include 'views/layouts/dokter_layout.php';
    }

    public function riwayat_pasien() {
        $pageTitle = 'Riwayat Pasien';
        ob_start(); include 'views/dokter/riwayat_pasien.php'; $content = ob_get_clean();
        include 'views/layouts/dokter_layout.php';
    }
}
