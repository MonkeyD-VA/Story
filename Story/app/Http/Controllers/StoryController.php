<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{

    protected $storyRepo;

    public function __construct(StoryRepositoryInterface $storyRepo)
    {
        $this->storyRepo = $storyRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $story = $this->storyRepo->getStory();
        Log::info('User has get list of story');
        return view('frontend\pages\story', compact('story'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info('User is going to create a new story');
        return view('frontend\pages\storyCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $story = $this->storyRepo->store($request);
        Log::info('User has created a new story');
        return redirect()->action([StoryController::class, 'create']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $story = $this->storyRepo->show($id);
        Log::info('User view a detail story');
        return view('/frontend/pages/storyDetail', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $story_id)
    {
        $story = $this->storyRepo->update($request, $story_id);
        Log::info('User has update a story');
        return redirect()->action([StoryController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $story_id)
    {
        $story = $this->storyRepo->destroy($story_id);
        Log::info('User destroy a story');
        return redirect()->action([StoryController::class, 'index'])->with('success','Dữ liệu xóa thành công.');
    }
}
