<?php

namespace App\Repositories\Story;

use App\Models\Page;
use App\Models\Story;
use Illuminate\Support\Facades\DB;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;

class StoryRepository implements StoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Story::class;
    }

    public function getStory()
    {
        $story = DB::table('stories')->select('*')->simplePaginate(10);
        return $story;
    }

    public function store(Request $request)
    {
        $story = new Story;
        $story->story_name = $request->story_name;
        $story->author_id = $request->author_id;
        $story->author_name = $request->author_name;
        $story->category = $request->category;
        $story->thumb = $request->thumb;

        $story->save();
    }

    public function show(string $id)
    {
        $story = DB::table('stories')
            ->where('story_id', '=', $id)
            ->first();
        return $story;
    }

    public function update(Request $request, string $story_id)
    {
        $story = Story::find($story_id);
        $story->story_name = $request->story_name;
        $story->author_id = $request->author_id;
        $story->author_name = $request->author_name;
        $story->category = $request->category;
        $story->thumb = $request->thumb;

        $story->save();
    }

    public function destroy(string $story_id)
    {
        $story = Story::find($story_id);
        $story->delete();
    }

    public function findPage(Request $request, string $story_id)
    {
        $page = DB::table('pages')
            ->where('story_id', '=', $story_id)
            ->get();
        return $page;
    }
}
