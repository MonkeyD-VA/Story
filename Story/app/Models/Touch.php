<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touch extends Model
{
    use HasFactory;
    protected $table = 'touches';

    protected $primaryKey = 'touch_id';

    protected $fillable = [
        'page_id',
        'text_id',
        'position',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function text()
    {
        return $this->hasOne(Text::class, 'text_id');
    }

}
