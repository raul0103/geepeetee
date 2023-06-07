<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function store(RegisteredUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /**
         *  Параметры для записи пользователя как администратор
         */
        if ($user->id == 1 || $request->role == 'admin') {
            $role_admin = Role::where('slug', 'admin')->first();
            $user->roles()->attach($role_admin->id);
        }

        return redirect()->route('login');
    }

    public function create(Request $request)
    {
        $access_time = Carbon::parse((int)$request->expires)->timezone('Europe/Moscow')->format('d-m-Y H:i:s');
        return view('pages.auth.register', [
            'access_time' => $access_time
        ]);
    }
}
