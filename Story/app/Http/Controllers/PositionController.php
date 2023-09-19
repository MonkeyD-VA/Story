<?php

namespace App\Http\Controllers;

use App\Repositories\Position\PositionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{

    public function __construct(PositionRepositoryInterface $repo)
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
                    'touch_id' => 'numeric',
                    'x' => 'numeric',
                    'y' => 'numeric',
                    'width' => 'numeric',
                    'height' => 'numeric',
                    'screenX' => 'numeric',
                    'screenY' => 'numeric',
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
        $data = $this->repo->getDataRequest($request);
        try {
            //Validated
            $validate = Validator::make(
                $data,
                [
                    'touch_id' => 'numeric',
                    'x' => 'numeric',
                    'y' => 'numeric',
                    'width' => 'numeric',
                    'height' => 'numeric',
                    'screenX' => 'numeric',
                    'screenY' => 'numeric',
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
