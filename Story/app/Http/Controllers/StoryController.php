<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $story = DB::table('stories')->select('*')->simplePaginate(10);
        // $story = $story->get();

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
        $story = new Story;
        // $story->story_id = $request->story_id;
        $story->story_name = $request->story_name;
        $story->author_id = $request->author_id;
        $story->author_name = $request->author_name;
        $story->category = $request->category;
        $story->thumb = $request->thumb;

        $story->save();
        return redirect()->action([StoryController::class, 'create']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $story = Story::where('story_id', '=', $id)->select('*')->first();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
