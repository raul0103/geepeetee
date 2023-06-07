<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptParserResult extends Model
{
    use HasFactory;

    public $fillable = ['request', 'response', 'modified', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
