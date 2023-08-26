<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class StoryController extends Controller
{
    protected $storyRepo;

    public function __construct(StoryRepositoryInterface $storyRepo)
    {
        $this->storyRepo = $storyRepo;
    }


    public function show(string $id)
    {   
        Log::info("API: show a detail story");
        try {
            $story = $this->storyRepo->show($id);
            return response()->json([
                'status' => true,
                'data' => $story
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $story_id)
    {
        Log::info("API: update a story");
        try {
            //Validated
            $validate = Validator::make($request->all(), 
            [
                'story_name' => 'string',
                'author_id' => 'numeric',
                'author_name' => 'string',
                'category' => 'string',
                'thumb' => 'string'
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $story = $this->storyRepo->update($request, $story_id);

            return response()->json([
                'status' => true,
                'message' => 'Update Successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function findPage(Request $request, $story_id) {
        $pages = $this->storyRepo->findPage($request, $story_id);
        Log::info("API: find pages of a story");
        return response()->json([
            'status' => true,
            'data' => $pages,
        ], 200);
    }

}
