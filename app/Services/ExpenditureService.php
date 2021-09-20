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
}
