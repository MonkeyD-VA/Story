<?php
namespace App\Repositories\Story;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface StoryRepositoryInterface
{
    public function getStory();

    public function store(Request $request);

    public function show(string $id);

    public function update(Request $request, string $story_id);

    public function destroy(string $story_id);

    public function findPage(Request $request, string $story_id);
}
