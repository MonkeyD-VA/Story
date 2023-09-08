<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;
    protected $table = 'texts';
    protected $primaryKey = 'text_id';

    protected $fillable = [
        'text_content',
        'audio_id',
        'audio_file',
        'audio_time',
        'text_type',
    ];

    public function textConfigs()
    {
        return $this->hasMany(TextConfig::class, 'text_id');
    }

    public function textTouches()
    {
        return $this->belongsTo(Touch::class, 'text_id');
    }

}
