<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination()
    {
    }

    public function create(array $attributes)
    {
    }

    public function update(array $attributes, $id)
    {
    }

    public function view($id)
    {
    }

    public function delete($id)
    {
    }
}
