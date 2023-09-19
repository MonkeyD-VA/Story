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

}
