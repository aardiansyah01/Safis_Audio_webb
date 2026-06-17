<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudioProcess extends Model
{
    protected $fillable = [
        'user_id',
        'original_file',
        'processed_file',
        'file_type',
        'duration',
        'noise_reduction',
        'audio_enhancement',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
