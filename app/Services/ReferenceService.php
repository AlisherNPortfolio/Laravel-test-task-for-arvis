<?php

namespace App\Services;

use App\Repositories\MeasureRepository;
use App\Repositories\ProductRepository;

class ReferenceService
{
    protected $productRepository;

    protected $measureRepository;

    public function __construct(ProductRepository $productRepository, MeasureRepository $measureRepository)
    {
        $this->productRepository = $productRepository;
        $this->measureRepository = $measureRepository;
    }

    public function getProductList()
    {
        return $this->productRepository->all();
    }

    public function getMeasureList()
    {
        return $this->measureRepository->all();
    }
}
