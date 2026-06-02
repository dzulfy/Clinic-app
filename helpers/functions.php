<?php
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function formatTanggal($date) {
    $bulan = ['Januari','Februari','Maret','April','Mei','Juni',
              'Juli','Agustus','September','Oktober','November','Desember'];
    $d = new DateTime($date);
    return $d->format('d') . ' ' . $bulan[$d->format('n')-1] . ' ' . $d->format('Y');
}

function formatWaktu($datetime) {
    return date('H:i', strtotime($datetime)) . ' WIB';
}

function generateId($prefix, $number) {
    return $prefix . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function setFlash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function activeMenu($page) {
    $url = $_GET['url'] ?? '';
    return strpos($url, $page) !== false ? 'bg-slate-800 text-white font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white';
}
