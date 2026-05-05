<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect sesuai role
        if (Auth::check()) {
            return $this->redirectToDashboard(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Proses login.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $remember = $request->boolean('remember');

        // Coba login
        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password yang Anda masukkan salah.'],
            ]);
        }

        $user = Auth::user();

        // Cek apakah akun aktif
        if (!$user->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => ['Akun Anda tidak aktif. Silakan hubungi administrator.'],
            ]);
        }

        // Regenerasi session untuk mencegah session fixation
        $request->session()->regenerate();

        // Redirect berdasarkan role
        return $this->redirectToDashboard($user);
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Optional: tambahkan log activity logout
        // activity()->log('User ' . $user?->email . ' logged out');

        return redirect()->route('login')->with('status', 'Anda telah berhasil logout.');
    }

    /**
     * Redirect user ke dashboard sesuai role.
     */
    protected function redirectToDashboard($user)
    {
        // Admin, Manager, Staff, Driver → Admin Panel
        if (in_array($user->role, ['admin', 'manager'])) {
            return redirect()->route('admin.dashboard');
        }

        // Default fallback
        return redirect()->route('home');
    }

    /**
     * Kirim reset password link (opsional).
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Email tersebut tidak terdaftar dalam sistem kami.',
        ]);

        // TODO: Implementasi kirim email reset password
        // Bisa menggunakan Laravel's built-in Password::sendResetLink()
        
        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }
}