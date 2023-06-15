<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptParserResult extends Model
{
    use HasFactory;

    public $fillable = ['request', 'response', 'modified', 'import_id'];

    public function import()
    {
        return $this->belongsTo(Import::class);
    }
}
