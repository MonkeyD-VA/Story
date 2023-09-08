<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextConfig extends Model
{
    use HasFactory;
    protected $table = 'text_configs';

    protected $fillable = [
        'page_id',
        'text_id',
        'position',
        'type',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function text()
    {
        return $this->belongsTo(Text::class, 'text_id');
    }

}
