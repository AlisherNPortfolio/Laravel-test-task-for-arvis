<?php

namespace App\Repositories;

use App\Models\ExpenditureItem;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Contracts\ExpenditureRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ExpenditureRepository extends BaseRepository implements ExpenditureRepositoryInterface
{
    public function __construct(ExpenditureItem $expenditure)
    {
        parent::__construct($expenditure);
    }

    public function paginate($perPage = 10)
    {
        return $this->model
            ->with(['measure', 'product'])
            ->paginate($perPage);
    }

    public function find($id): ?Model
    {
        return $this->model
            ->with(['measure', 'product'])
            ->find($id);
    }
}
