<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected $primaryKey = 'position_id';

    protected $fillable = [
        'touch_id',
        'x',
        'y',
        'width',
        'height',
        'screenX',
        'screenY'
    ];

    public function belongTouches()
    {
        return $this->belongsTo(Touch::class, 'touch_id');
    }
}
