<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GptApiKey extends Model
{
    use HasFactory;

    public $fillable = ['name', 'key', 'user_id', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRemoveActive()
    {
        $active_api_key = Auth::user()->getActiveGptApiKey();
        $active_api_key?->update(['active' => 0]);
    }
}
