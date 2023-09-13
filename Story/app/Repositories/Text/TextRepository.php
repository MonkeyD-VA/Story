<?php

namespace App\Repositories\Text;

use App\Repositories\BaseRepository;
use App\Repositories\Text\TextRepositoryInterface;

class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Text::class;
    }

}