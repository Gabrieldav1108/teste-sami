<?php

namespace App\Repositories\Interfaces;

use App\Models\People;
use Illuminate\Pagination\LengthAwarePaginator;

interface PeopleRepositoryInterface
{
    public function all(): LengthAwarePaginator;
    public function find(int $id): People;
    public function create(array $data): People;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}