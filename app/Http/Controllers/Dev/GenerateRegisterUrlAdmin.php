<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class GenerateRegisterUrlAdmin extends Controller
{
    /** Функция для запуска через tinker для регистрации первого админа */
    public static function index()
    {
        return URL::temporarySignedRoute(
            'register',
            now()->addMinutes(10),
            ['role' => 'admin']
        );
    }
}
