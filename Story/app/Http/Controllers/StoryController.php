<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class StoryController extends Controller
{
    protected $repo;

    public function __construct(StoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        Log::info('User has get list of story');
        try {
            $story = $this->repo->getAll();
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

    public function show(string $id)
    {
        Log::info("API: show a detail story");
        try {
            $story = $this->repo->show($id);
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

    public function store(Request $request)
    {
        $data = $this->repo->getDataRequest($request) ;
        
        try {
            //Validated
            $validate = Validator::make(
                $data,
                [
                    'story_name' => 'string',
                    'author_id' => 'numeric',
                    'author_name' => 'string',
                    'category' => 'string',
                    'thumb' => 'string'
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $story = $this->repo->store($data);
            return response()->json([
                'status' => true,
                'message' => 'Store Successfully',
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
        $data = $this->repo->getDataRequest($request) ;
        Log::info("API: update a story");
        try {
            //Validated
            $validate = Validator::make(
                $data,
                [
                    'story_name' => 'string',
                    'author_id' => 'numeric',
                    'author_name' => 'string',
                    'category' => 'string',
                    'thumb' => 'string'
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $story = $this->repo->update($story_id, $data);

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

    public function destroy(string $story_id)
    {
        try {
            $story = $this->repo->destroy($story_id);
            return response()->json([
                'status' => true,
                'message' => 'Destroy Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function findPage($story_id)
    {
        $pages = $this->repo->findPage($story_id);
        Log::info("API: find pages of a story");
        return response()->json([
            'status' => true,
            'data' => $pages,
        ], 200);
    }
}
