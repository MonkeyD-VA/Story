<?php

namespace App\Http\Controllers;

use App\Repositories\Touch\TouchRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class TouchController extends Controller
{
    public function __construct(TouchRepositoryInterface $repo)
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
                    'page_id' => 'numeric',
                    'text_id' => 'numeric',
                ]
            );

            if ($validate->fails()) {
                return $this->responseJson($validate->error(), null, false, 401);
            }

            $this->repo->store($data);
            return $this->responseJson('store success', $data);
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
                    'page_id' => 'numeric',
                    'text_id' => 'numeric',
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

}
