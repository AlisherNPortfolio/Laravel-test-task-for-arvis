<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function create(array $attributes): Model;

    public function find($id): ?Model;

    public function update(array $attributes): bool;

    public function delete($id): ?bool;

    public function all(): Collection;

    public function paginate($perPage);
}
