<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptParserStatusByUser extends Model
{
    use HasFactory;

    public $fillable = ['request', 'status', 'message', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function updateStatus($status)
    {
        $this->update([
            'status' => $status
        ]);
    }
}
