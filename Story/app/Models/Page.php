<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    
    protected $table = 'pages';
    protected $primaryKey = 'page_id';

    protected $fillable = [
        'page_number',
        'story_id',
        'image_background',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }

    public function textConfigs()
    {
        return $this->hasMany(TextConfig::class, 'page_id');
    }

    public function pageTouches()
    {
        return $this->hasMany(Touch::class, 'page_id');
    }

}
