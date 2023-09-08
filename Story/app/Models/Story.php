<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'stories';
    protected $primaryKey = 'story_id';

    protected $fillable = [
        'story_name',
        'author_id',
        'author_name',
        'category',
        'thumb',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class, 'story_id');
    }
}
