<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function store($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    public function getDataRequest(Request $request);
}
