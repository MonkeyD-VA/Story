<?php

namespace App\Repositories\Text;

use App\Repositories\BaseRepository;
use App\Repositories\Text\TextRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Text::class;
    }

    public function getTextOfPage($story_id, $page_number){
        $texts = DB::table('pages as p')
        ->join('touches as tou', 'p.page_id', '=', 'tou.page_id')
        ->join('texts as t', 'tou.text_id', '=', 't.text_id')
        ->select('*')
        ->where('p.story_id', '=', $story_id)
        ->where('p.page_number', '=', $page_number)
        ->get();
        return $texts;
    }
}
