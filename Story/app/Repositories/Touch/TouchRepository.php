<?php

namespace App\Repositories\Touch;

use App\Repositories\BaseRepository;
use App\Repositories\Touch\TouchRepositoryInterface;

class TouchRepository extends BaseRepository implements TouchRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Touch::class;
    }

}
