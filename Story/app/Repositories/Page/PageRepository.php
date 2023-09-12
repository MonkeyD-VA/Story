<?php

namespace App\Repositories\Page;

use App\Repositories\BaseRepository;
use App\Repositories\Page\PageRepositoryInterface;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Page::class;
    }

    public function getPageByStory($id) {
        return $this->model->where('story_id', $id)->get();
    }

}
