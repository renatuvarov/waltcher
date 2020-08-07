<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Entities\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ], [
            'email.required' => 'Это поле обязательно для заполнения',
            'email.string' => 'Значение этого поля должно быть строкой',
            'email.email' => 'Некорректный адрес электронной почты',
            'email.max' => 'Значение поля не должно превышать 255 символов',
            'email.unique' => 'Пользователь с таким :email уже существует',

            'password.required' => 'Это поле обязательно для заполнения',
            'password.string' => 'Значение этого поля должно быть строкой',
            'password.min' => 'Значение поля должно быть не короче 8 символов',

            'password_confirmation.required' => 'Это поле обязательно для заполнения',
            'password_confirmation.string' => 'Значение этого поля должно быть строкой',
            'password_confirmation.min' => 'Значение поля должно быть не короче 8 символов',
            'password_confirmation.same' => 'Пароли должны совпадать',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_USER,
        ]);
    }

    protected function registered(Request $request, $user)
    {
        Auth::logout();
        return redirect()->route('verification.notice');
    }
}
