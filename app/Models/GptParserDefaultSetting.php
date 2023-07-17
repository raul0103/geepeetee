<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptParserDefaultSetting extends Model
{
    use HasFactory;

    public $fillable = ['key', 'default', 'description', 'values', 'type'];
}
