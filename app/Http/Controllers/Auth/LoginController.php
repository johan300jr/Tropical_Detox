<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Verificar si el usuario está inactivo
        if (!$user->estado) {
            Auth::logout(); // Desconectar al usuario si está inactivo
            return redirect()->back()->withErrors(['account' => 'Su cuenta está inactiva.']); // Redirigir con un mensaje de error
        }
    
        // Verificar si el rol asociado al usuario está inactivo
        $rol = $user->rol;
        if ($rol && !$rol->is_active) {
            Auth::logout(); // Desconectar al usuario si el rol está inactivo
            return redirect()->back()->withErrors(['account' => 'El rol asociado está inactivo.']); // Redirigir con un mensaje de error
        }
    
        return redirect()->intended($this->redirectTo); // Redirigir al destino previsto después de iniciar sesión
    }
    

}