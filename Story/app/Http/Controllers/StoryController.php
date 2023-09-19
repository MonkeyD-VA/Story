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
    public function __construct(StoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
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
                return $this->responseJson($validate->error(), null, false, 401);
            }

            $dataReturn = $this->repo->store($data);
            return $this->responseJson('create story success', $dataReturn);
        } catch (\Throwable $th) {
            $this->responseJson($th->getMessage(), null, false, 500);
        }
    }

    public function update(Request $request, string $id)
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
                return $this->responseJson($validate->error(), null, false, 401);
            }

            $dataReturn = $this->repo->update($id, $data);

            return $this->responseJson('updates success', $dataReturn);
        } catch (\Throwable $th) {
            return $this->responseJson($th->getMessage(), null, false, 500);
        }
    }

    public function findPage($story_id)
    {   
        $pages = $this->repo->findPage($story_id);
        Log::info("API: find pages of a story");
        return $this->responseJson('find pages success', $pages);;
    }
}


// ruts gon: goto next, function to return same format
// add to repo