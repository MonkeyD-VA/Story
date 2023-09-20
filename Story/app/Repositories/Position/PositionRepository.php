<?php

namespace App\Repositories\Position;

use App\Repositories\BaseRepository;
use App\Repositories\Position\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Position::class;
    }

    public function getPositionInPage(string $id){
        $texts = DB::table('positions as pos')
        ->join('touches as tou', 'pos.touch_id', '=', 'tou.touch_id')
        ->select('*')
        ->where('tou.page_id', '=', $id)
        ->get();
        return $texts;
    }

}
