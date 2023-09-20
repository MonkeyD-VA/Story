<?php

namespace App\Repositories\Page;

use App\Repositories\BaseRepository;
use App\Repositories\Page\PageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Page::class;
    }

    public function getAllOfPage($story_id, $page_number){
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
