<?php
class AdminController {
    private $pdo;
    private $pasienModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        require_once 'models/Pasien.php';
        $this->pasienModel = new Pasien($pdo);
    }

    public function index() {
        header('Location: /clinicv2/admin/dashboard');
        exit;
    }

    public function dashboard() {
        $pageTitle = 'Dashboard';
        
        $totalPasien = $this->pasienModel->count();
        
        ob_start();
        include 'views/admin/dashboard.php';
        $content = ob_get_clean();
        
        include 'views/layouts/admin_layout.php';
    }

    public function pasien($id = null) {
        $pageTitle = 'Data Pasien';
        
        if ($id) {
            $pasien = $this->pasienModel->getById($id);
            // Show detail logic
        } else {
            $limit = 10;
            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
            $offset = ($page - 1) * $limit;
            $pasienList = $this->pasienModel->getAll($limit, $offset);
            $totalPasien = $this->pasienModel->count();
            $totalPages = ceil($totalPasien / $limit);
        }
        
        ob_start();
        include 'views/admin/pasien.php';
        $content = ob_get_clean();
        
        include 'views/layouts/admin_layout.php';
    }
    
    public function pemeriksaan_awal() {
        $pageTitle = 'Pemeriksaan Awal';
        ob_start(); include 'views/admin/pemeriksaan_awal.php'; $content = ob_get_clean();
        include 'views/layouts/admin_layout.php';
    }
    
    public function antrean() {
        $pageTitle = 'Manajemen Antrean';
        ob_start(); include 'views/admin/antrean.php'; $content = ob_get_clean();
        include 'views/layouts/admin_layout.php';
    }
    
    public function pembayaran() {
        $pageTitle = 'Pembayaran';
        ob_start(); include 'views/admin/pembayaran.php'; $content = ob_get_clean();
        include 'views/layouts/admin_layout.php';
    }
    
    public function rujukan() {
        $pageTitle = 'Rujukan';
        ob_start(); include 'views/admin/rujukan.php'; $content = ob_get_clean();
        include 'views/layouts/admin_layout.php';
    }
    
    public function laporan() {
        $pageTitle = 'Laporan';
        ob_start(); include 'views/admin/laporan.php'; $content = ob_get_clean();
        include 'views/layouts/admin_layout.php';
    }
}
