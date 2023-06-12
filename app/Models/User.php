<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function gptApiKeys()
    {
        return $this->hasMany(GptApiKey::class);
    }

    public function getActiveGptApiKey()
    {
        return $this->gptApiKeys()->where('active', 1)->first();
    }

    public function parserStatus($request = null)
    {
        $status_data = $this->hasMany(GptParserStatusByUser::class);

        if (isset($request->order))
            $status_data->orderBy($request->order, $request->sort);
        else
            $status_data->orderBy('id', 'desc');

        return $status_data;
    }

    public function getParserResultDescId()
    {
        return $this->hasMany(GptParserResult::class)->orderBy('id', 'desc');
    }
}
