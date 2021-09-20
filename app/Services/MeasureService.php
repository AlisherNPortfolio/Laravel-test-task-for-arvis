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
}
