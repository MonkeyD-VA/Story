<?php

namespace App\Http\Controllers;

use App\Repositories\Text\TextRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TextController extends Controller
{
    public function __construct(TextRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->repo->getDataRequest($request);

        try {
            //Validated
            $validate = Validator::make(
                $data,
                [
                    'text_content' => 'string',
                    'audio_id' => 'numeric',
                    'audio_file' => 'string',
                    'audio_time' => 'numeric',
                    'text_type' => 'string',
                ]
            );

            if ($validate->fails()) {
                return $this->responseJson($validate->error(), null, false, 401);
            }

            $dataReturn = $this->repo->store($data);
            return $this->responseJson('store success', $dataReturn);
        } catch (\Throwable $th) {
            return $this->responseJson($th->getMessage(), null, false, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->repo->getDataRequest($request) ;
        try {
            //Validated
            $validate = Validator::make(
                $data,
                [
                    'text_content' => 'string',
                    'audio_id' => 'numeric',
                    'audio_file' => 'string',
                    'audio_time' => 'numeric',
                    'text_type' => 'string',
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

    public function updateTextInList(Request $request)
    {
        $data = $this->repo->getDataRequest($request) ;
        $dataReturn = $this->repo->updateTextInList($data);
        return $this->responseJson('update and create success', $dataReturn);
    }


}
