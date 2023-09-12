<?php

namespace App\Repositories\TextConfig;

use App\Repositories\BaseRepository;
use App\Repositories\TextConfig\TextConfigRepositoryInterface;

class TextConfigRepository extends BaseRepository implements TextConfigRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\TextConfig::class;
    }

}
