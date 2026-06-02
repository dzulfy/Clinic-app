<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Pendataan Pasien</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">
    <div class="flex-1 bg-gradient-to-br from-slate-900 to-slate-800 flex flex-col justify-center items-center text-white p-12 relative overflow-hidden hidden md:flex">
        <!-- Decorative blobs -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-40 -right-40 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="z-10 max-w-md w-full">
            <h1 class="text-4xl font-bold mb-4">Sistem Pendataan Pasien</h1>
            <p class="text-slate-300 text-lg mb-12">Solusi manajemen data medis terintegrasi untuk efisiensi layanan kesehatan Klinik Medika.</p>
            
            <p class="text-sm text-slate-400 mb-4 uppercase tracking-wider font-semibold">Akses Tersedia Untuk</p>
            <div class="flex gap-4">
                <span class="px-4 py-2 bg-slate-800/50 rounded-lg border border-slate-700/50 flex items-center shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-blue-400 mr-2"></span> Admin
                </span>
                <span class="px-4 py-2 bg-slate-800/50 rounded-lg border border-slate-700/50 flex items-center shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2"></span> Dokter
                </span>
                <span class="px-4 py-2 bg-slate-800/50 rounded-lg border border-slate-700/50 flex items-center shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-purple-400 mr-2"></span> Owner
                </span>
            </div>
        </div>
    </div>
    
    <div class="flex-1 flex flex-col justify-center items-center bg-white p-8 relative">
        <div class="w-full max-w-md">
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Welcome Back</h2>
                <p class="text-slate-500">Silakan masuk untuk mengelola data pasien.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-600 border border-red-200 p-4 rounded-lg mb-6 text-sm flex items-start">
                    <svg class="w-5 h-5 mr-2 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/clinicv2/login" method="POST" class="space-y-5">
                <div>
                    <label for="login" class="block text-sm font-medium text-slate-700 mb-1">Email atau Username</label>
                    <input type="text" id="login" name="login" required placeholder="nama@klinik.com" 
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        value="<?= isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '' ?>">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" required placeholder="••••••••" 
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember" class="ml-2 block text-sm text-slate-600 cursor-pointer">Remember Me</label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-3 px-4 rounded-lg shadow-md shadow-blue-500/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0 mt-2">
                    Login
                </button>
            </form>
            
            <div class="mt-12 text-center text-sm text-slate-400">
                <p>&copy; 2024 Klinik Medika. All rights reserved.</p>
                <p class="mt-1">Versi 2.4.0 Build 20241012</p>
            </div>
        </div>
    </div>
</body>
</html>
