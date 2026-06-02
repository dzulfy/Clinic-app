<?php
function requireLogin($role = null) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /clinicv2/login');
        exit;
    }
    if ($role && $_SESSION['user_role'] !== $role) {
        header('Location: /clinicv2/login');
        exit;
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function currentUser() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'nama' => $_SESSION['user_nama'] ?? '',
        'role' => $_SESSION['user_role'] ?? '',
        'email' => $_SESSION['user_email'] ?? ''
    ];
}
