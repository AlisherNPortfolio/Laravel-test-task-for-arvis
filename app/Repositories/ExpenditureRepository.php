<?php

namespace App\Repositories;

use App\Models\ExpenditureItem;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Contracts\ExpenditureRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class ExpenditureRepository extends BaseRepository implements ExpenditureRepositoryInterface
{
    public function __construct(ExpenditureItem $expenditure)
    {
        parent::__construct($expenditure);
    }

    public function paginate($perPage = 10)
    {
        return app(Pipeline::class)
            ->send($this->model::query()->with(['measure', 'product']))
            ->through([
                \App\FilterQuery\SearchByProduct::class
            ])
            ->thenReturn()
            ->paginate($perPage);
    }

    public function find($id): ?Model
    {
        return $this->model
            ->with(['measure', 'product'])
            ->find($id);
    }
}
