<?php

namespace App\Services;

use App\Repositories\ExpenditureRepository;

class ExpenditureService extends BaseService
{
    protected $repository;

    public function __construct(ExpenditureRepository $repository)
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
