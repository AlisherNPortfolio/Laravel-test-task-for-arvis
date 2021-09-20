<?php

namespace App\Repositories;

use App\Models\ExpenditureItem;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Contracts\ExpenditureRepositoryInterface;

class ExpenditureRepository extends BaseRepository implements ExpenditureRepositoryInterface
{
    public function __construct(ExpenditureItem $expenditure)
    {
        parent::__construct($expenditure);
    }
}
