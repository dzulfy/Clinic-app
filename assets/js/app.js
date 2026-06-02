// Chart defaults
if (typeof Chart !== 'undefined') {
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b';
    Chart.defaults.scale.grid.color = '#f1f5f9';
}

function confirmDelete(url, message = 'Apakah Anda yakin ingin menghapus data ini?') {
    if (confirm(message)) {
        window.location.href = url;
    }
}

// Auto hide flash messages
document.addEventListener('DOMContentLoaded', () => {
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.opacity = '0';
            flashMessage.style.transition = 'opacity 0.5s ease';
            setTimeout(() => flashMessage.remove(), 500);
        }, 5000);
    }
});
