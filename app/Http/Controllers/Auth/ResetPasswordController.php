<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Override the reset password functionality to handle custom model.
     */
    public function reset(Request $request)
    {
        // Validação do formulário
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Busca o token e valida a redefinição de senha
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                // Atualiza a senha do usuário
                $user->senha = Hash::make($password);
                $user->save();

                // Opcional: Loga automaticamente o usuário após a redefinição
                Auth::login($user);
            }
        );

        // Trata o status da redefinição
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Sua senha foi redefinida com sucesso.');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
