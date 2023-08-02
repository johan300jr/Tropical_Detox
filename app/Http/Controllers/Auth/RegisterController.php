<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|regex:/^[A-Za-z\s]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-z\s]+$/|max:30',
            'estado',
            'documento' => [
                'required',
                'string',
                'max:15',
                'unique:users,documento',
                'regex:/^[0-9]+$/'
            ],
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 30 caracteres.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.unique' => 'El documento ingresado ya está registrado.',
            'documento.regex' => 'El campo documento no válido.',
            'documento.max' => 'El campo documento no debe tener más de 15 caracteres.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.numeric' => 'El campo teléfono debe contener solo números.',
            'telefono.digits' => 'El campo teléfono debe tener 10 dígitos.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.max' => 'El campo dirección no debe tener más de 50 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.unique' => 'El email ingresado ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $existingUser = User::where('documento', $data['documento'])->first();
    
        if ($existingUser) {
            return redirect()->route('register')
                ->withInput($data)
                ->withErrors(['documento' => 'El documento ya está registrado.']);
        }
    
        $user =  User::create([
            'name' => $data['name'],
            'apellidos' => $data['apellidos'],
            'estado' => 1, // Estado por defecto activo (1)
            'documento' => $data['documento'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    
        $role = Role::findByName('cliente');
        $user->assignRole($role);
    
        return $user;
    }
    
    
}
