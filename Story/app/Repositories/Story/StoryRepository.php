<?php

namespace App\Repositories\Story;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;

class StoryRepository extends BaseRepository implements StoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Story::class;
    }


    public function findPage($story_id)
    {
        $story = $this->show($story_id);
        $page = $story->pages()->get();
        return $page;
    }
}
