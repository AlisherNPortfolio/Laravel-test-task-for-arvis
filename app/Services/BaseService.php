<?php

namespace App\Services;

abstract class BaseService
{
    protected function successResponse($data, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = '', $code = 0, $details = null)
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message,
            'details' => $details
        ]);
    }

    abstract public function pagination();

    abstract public function create(array $attributes);

    abstract public function update(array $attributes, $id);

    abstract public function delete($id);

    abstract public function view($id);
}
