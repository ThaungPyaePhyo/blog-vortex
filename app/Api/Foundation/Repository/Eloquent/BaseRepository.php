<?php

namespace App\Api\Foundation\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Api\Foundation\Repository\EloquentRepositoryInterface;

abstract class BaseRepository implements EloquentRepositoryInterface
{

    public function all(array $options = [])
    {
        return $this->optionsQuery($options)->get();
    }

    protected function optionsQuery(array $options)
    {
        return $this->connection()->query();
    }

    public function getDataById(int $id, array $relations = [])
    {
        return $this->connection()->query()->with($relations)->where('id', $id)->first();
    }

    public function insert(array $data)
    {
        return $this->connection()->query()->create($data);
    }

    public function update(array $data, int $id): int
    {
        return $this->connection()->query()->find($id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->connection()->query()->find($id)->delete();
    }

    abstract public function connection(): Model;
}
