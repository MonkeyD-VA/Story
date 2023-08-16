<?php
namespace App\Repositories\Story;

use App\Models\Story;
use App\Repositories\Story\StoryRepositoryInterface;

class StoryRepository implements StoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Story::class;
    }

    public function getStory()
    {
        return Story::latest()->paginate();
    }
}
