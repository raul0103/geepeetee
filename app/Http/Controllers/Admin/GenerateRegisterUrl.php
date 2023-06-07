<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class GenerateRegisterUrl extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->config = [
            'route_name' => 'register',
            'lifetime' => 10,
            'is_admin' => []
        ];
    }

    public function index()
    {
        return view('pages.admin.generate-register-url', [
            'access_time' => null,
            'register_url' => null
        ]);
    }

    /** Ссылка для регистрации администратора */
    public function admin()
    {
        return view('pages.admin.generate-register-url', $this->generate(['role' => 'admin']));
    }

    /** Ссылка для регистрации обычного пользователя */
    public function member()
    {
        return view('pages.admin.generate-register-url', $this->generate());
    }

    /**
     * Генериратор ссылки
     * 
     * @param $params - массив данных которые будут отображены GET параметрами
     */
    protected function generate($params = [])
    {
        $access_time =  Carbon::now()->addMinute($this->config['lifetime'])->timezone('Europe/Moscow')->format('d-m-Y H:i:s');
        return [
            'access_time' => $access_time,
            'register_url' => URL::temporarySignedRoute(
                $this->config['route_name'],
                now()->addMinutes($this->config['lifetime']),
                $params
            )
        ];
    }
}
