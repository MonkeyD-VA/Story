<?php

namespace App\Repositories\Position;

use App\Repositories\BaseRepository;
use App\Repositories\Position\PositionRepositoryInterface;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Position::class;
    }
}
