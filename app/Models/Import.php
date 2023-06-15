<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Import extends Model
{
    use HasFactory;

    public $fillable = ['name', 'user_id'];


    public function statuses()
    {
        return $this->hasMany(GptParserStatus::class);
    }

    public function results()
    {
        return $this->hasMany(GptParserResult::class);
    }


    public function scopeByUser($query)
    {
        $user = Auth::user();
        return $query->where('user_id', $user->id)->with('statuses', 'results')->orderBy('id', 'desc')->get();
    }
}
