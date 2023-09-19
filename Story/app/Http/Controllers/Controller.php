<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $repo;

    public function responseJson($message = '', $data = null, $status = true, $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 5);
            $data = $this->repo->getAll()->paginate($perPage);
            return $this->responseJson('Get all success', $data);
        } catch (\Throwable $th) {
            return $this->responseJson($th->getMessage(), null, false, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->repo->show($id);
            return $this->responseJson('Get detail success', $data);
        } catch (\Throwable $th) {
            return $this->responseJson($th->getMessage(), null, false, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->repo->destroy($id);
            return $this->responseJson('Destroy success');
        } catch (\Throwable $th) {
            return $this->responseJson($th->getMessage(), null, false, 500);
        }
    }
}
