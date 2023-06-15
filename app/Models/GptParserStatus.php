<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptParserStatus extends Model
{
    use HasFactory;

    public $fillable = ['request', 'status', 'message', 'import_id'];

    public function import()
    {
        return $this->belongsTo(Import::class);
    }

    function updateStatus($status)
    {
        $this->update([
            'status' => $status
        ]);
    }
}
