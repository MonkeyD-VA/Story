<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('frontend\pages\story', compact('story'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend\pages\storyCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $story = $this->storyRepo->store($request);
        return redirect()->action([StoryController::class, 'create']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $story = $this->storyRepo->show($id);
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
        return redirect()->action([StoryController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $story_id)
    {
        $story = $this->storyRepo->destroy($story_id);
        return redirect()->action([StoryController::class, 'index'])->with('success','Dữ liệu xóa thành công.');
    }
}
