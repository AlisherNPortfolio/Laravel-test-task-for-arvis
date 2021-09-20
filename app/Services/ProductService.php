<?php

namespace App\Services;

use App\Classes\ErrorMessages;
use App\Repositories\ProductRepository;
use PDOException;

class ProductService extends BaseService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination()
    {
        return $this->repository->paginate();
    }

    public function create(array $attributes)
    {
        try {
            $product = $this->repository->create($attributes);

            return $this->successResponse($product, 201);
        } catch (PDOException $e) {
            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE,
                ErrorMessages::CAN_NOT_CREATE_MSG,
                $e->getMessage()
            );
        }
    }

    public function update(array $attributes, $id)
    {
        try {

            $product = $this->getProduct($id);

            $product->name = $attributes['name'];

            $product->save();

            return $this->successResponse($product, 201);
        } catch (PDOException $e) {

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE,
                ErrorMessages::CAN_NOT_CREATE_MSG,
                $e->getMessage()
            );
        }
    }

    public function view($id)
    {
        return $this->getProduct($id);
    }

    public function delete($id)
    {
        $product = $this->getProduct($id);

        try {

            return $product->delete();
        } catch (PDOException $e) {

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_DELETE_MSG,
                ErrorMessages::CAN_NOT_DELETE,
                $e->getMessage()
            );
        }
    }

    private function getProduct($id)
    {
        $product = $this->repository->find($id);

        if (!$product) {
            abort(ErrorMessages::NOT_FOUND, ErrorMessages::NOT_FOUND_MSG);
        }

        return $product;
    }
}
