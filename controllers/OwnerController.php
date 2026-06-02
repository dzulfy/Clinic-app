<?php
class OwnerController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        header('Location: /clinicv2/owner/dashboard');
        exit;
    }

    public function dashboard() {
        $pageTitle = 'Dashboard Analytics';
        ob_start();
        include 'views/owner/dashboard.php';
        $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }

    public function laporan_keuangan() {
        $pageTitle = 'Laporan Keuangan';
        ob_start(); include 'views/owner/laporan_keuangan.php'; $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }

    public function monitoring_obat() {
        $pageTitle = 'Monitoring Obat';
        ob_start(); include 'views/owner/monitoring_obat.php'; $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }

    public function log_stok() {
        $pageTitle = 'Log Stok Obat';
        ob_start(); include 'views/owner/log_stok.php'; $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }

    public function backup() {
        $pageTitle = 'Backup Database';
        ob_start(); include 'views/owner/backup.php'; $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }

    public function audit_log() {
        $pageTitle = 'Audit Log';
        ob_start(); include 'views/owner/audit_log.php'; $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }

    public function pengaturan() {
        $pageTitle = 'Pengaturan';
        ob_start(); include 'views/owner/pengaturan.php'; $content = ob_get_clean();
        include 'views/layouts/owner_layout.php';
    }
}
