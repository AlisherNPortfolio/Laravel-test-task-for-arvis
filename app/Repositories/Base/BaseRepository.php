<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Support\Collection;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find($id): ?Model
    {
        return $this->model->with(['measure', 'product'])->find($id);
    }

    public function update(array $attributes): bool
    {
        return $this->model->fill($attributes)->save();
    }

    public function delete($id): ?bool
    {
        return $this->model->delete($id);
    }

    public function all(): Collection
    {
        return $this->model->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }
}
