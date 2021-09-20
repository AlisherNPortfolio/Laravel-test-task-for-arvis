<?php

namespace App\Repositories;

use App\Models\Measure;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Contracts\MeasureRepositoryInterface;

class MeasureRepository extends BaseRepository implements MeasureRepositoryInterface
{
    public function __construct(Measure $measure)
    {
        parent::__construct($measure);
    }
}
