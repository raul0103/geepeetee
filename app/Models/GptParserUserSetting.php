<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptParserUserSetting extends Model
{
    use HasFactory;

    public $fillable = ['default_setting_id', 'user_id', 'value'];
}
