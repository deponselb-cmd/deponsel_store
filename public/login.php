<?php

// routes/web.php
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

// resources/views/auth/login.blade.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NetBill Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center">

<div class="bg-white rounded-xl shadow-xl w-full max-w-md p-8">
    <h2 class="text-2xl font-bold mb-2">Selamat Datang</h2>
    <p class="text-gray-500 mb-6">Masuk ke akun Anda</p>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-4">
            <label class="block text-sm">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex items-center mb-4">
            <input type="checkbox" name="remember" class="mr-2">
            <label>Ingat Saya</label>
        </div>

        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            Masuk
        </button>
    </form>
</div>

</body>
</html>

// Migration users table (if not exists)
// database/migrations/xxxx_create_users_table.php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});

// Example seeder
use Illuminate\Support\Facades\Hash;

DB::table('users')->insert([
    'name' => 'Admin',
    'email' => 'admin@netbillpro.id',
    'password' => Hash::make('admin123'),
]);
