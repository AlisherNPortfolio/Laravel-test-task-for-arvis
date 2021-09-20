<?php

namespace App\Services;

use App\Repositories\MeasureRepository;

class MeasureService extends BaseService
{
    protected $repository;

    public function __construct(MeasureRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination()
    {
        return $this->repository->paginate();
    }

    public function create(array $attributes)
    {
    }

    public function update(array $attributes, $id)
    {
    }

    public function delete($id)
    {
    }
}
