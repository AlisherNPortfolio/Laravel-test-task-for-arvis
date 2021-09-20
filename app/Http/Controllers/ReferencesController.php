<?php

namespace App\Http\Controllers;

use App\Services\ReferenceService;

class ReferencesController extends Controller
{
    private $service;

    public function __construct(ReferenceService $service)
    {
        $this->service = $service;
    }

    public function getProducts()
    {
        return $this->service->getProductList();
    }

    public function getMeasures()
    {
        return $this->service->getMeasureList();
    }
}
