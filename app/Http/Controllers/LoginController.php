<?php

namespace App\Http\Controllers;

use App\Models\curhat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function home()
    {
        $curhat = curhat::where('anonymous', '<', '2')->orderBy('created_at', 'desc')->paginate(30);
        return view('home', ['curhat' => $curhat]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak sesuai!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password harus terdapat minimal 8 character!'
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'E-mail atau password yang anda masukkan salah!'
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:4',
            'dob' => 'required|date',
            'email_register' => 'required|email',
            'password_register' => 'required|min:8|confirmed',
            'password_register_confirmation' => 'required|min:8'
        ], [
            'name.required' => 'Nama wajib diisi!',
            'name.max' => 'Nama tidak boleh lebih dari 50 character!',
            'name.min' => 'Nama harus terdapat minimal 4 character!',
            'dob.required' => 'Tanggal lahir wajib diisi!',
            'dob.date' => 'Format tanggal lahir tidak sesuai!',
            'email_register.required' => 'Email wajib diisi!',
            'email_register.email' => 'Format email tidak sesuai!',
            'password_register.required' => 'Password wajib diisi!',
            'password_register.min' => 'Password harus terdapat minimal 8 character!',
            'password_register.confirmed' => 'Password tidak sama!',
            'password_register_confirmation.required' => 'Konfirmasi password wajib diisi!',
            'password_register_confirmation.min' => 'Konfirmasi password harus terdapat minimal 8 character!'
        ]);

        $user = User::where('email', $request->email_register)->first();

        if ($user != NULL) {
            return redirect()->back()->with('registerError', 'E-mail yang anda masukkan sudah terdaftar!');
        }

        $user = User::where('name', $request->name)->first();

        if ($user != NULL) {
            return redirect()->back()->with('registerError', 'Nama yang anda masukkan sudah terdaftar!');
        }

        User::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'age' => Carbon::parse($request->dob)->diff(Carbon::now())->y,
            'email' => $request->email_register,
            'password' => Hash::make($request->password_register)
        ]);

        $user = Auth::attempt([
            'email' => $request->email_register,
            'password' => $request->password_register
        ]);

        event(new Registered($user));

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function verify()
    {
        return view('Verify');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/');
    }

    public function resendVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verifikasi email telah dikirim ke email anda!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function GantiPassword(Request $request)
    {

        $request->validate([
            'Password_gantipassword' => 'required|min:8',
            'NewPassword' => 'required|min:8|confirmed',
            'NewPassword_confirmation' => 'required|min:8'
        ]);

        if (Hash::check($request->NewPassword, auth()->user()->password)) {
            return redirect()->back()->with('gantiPasswordError', 'Password baru anda sama dengan password lama!');
        } elseif (Hash::check($request->Password_gantipassword, auth()->user()->password)) {
            DB::table('users')->where('id', Auth::user()->id)
                ->update([
                    'password' => bcrypt($request->NewPassword),
                ]);

            return redirect("/");
        } else {
            return redirect()->back()->with('gantiPasswordError', 'Password salah!');
        }
    }
}
