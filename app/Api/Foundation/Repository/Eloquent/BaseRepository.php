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
        $query = $this->connection()->query();

        if (isset($options['limit'])) {
            $query = $query->limit($options['limit']);
        }

        if (isset($options['offset'])) {
            $query = $query->offset($options['offset']);
        }

        if (isset($options['order_by'])) {
            if (is_array($options['order_by'])) {
                foreach ($options['order_by'] as $column => $orderBy) {
                    $query = $query->orderBy($column, $orderBy);
                }
            } else {
                $query = $query->orderBy('created_at', $options['order_by']);
            }
        } else {
            $query = $query->orderBy('created_at', 'desc');
        }

        if (isset($options['with'])) {
            $query = $query->with($options['with']);
        }

        if (isset($options['only'])) {
            $query = $query->select($options['only']);
        }

        if (isset($options['id'])) {
            //            $query = $query->where('id', '=', $options['id']);
            $query = $query->find($options['id']);
        }

        if (isset($options['country_id'])) {
            $query = $query->where('country_id', $options['country_id']);
        }
        if (isset($options['status'])) {
            $query = $query->where('status', '=', $options['status']);
        }

        if (!empty($options['uuid'])) {
            $query = $query->where('uuid', '=', $options['uuid']);
        }

        return $query;
    }

    public function getDataByOptions(array $options = [])
    {
        return $this->optionsQuery($options)->first();
    }

    public function getDataById(int $id, array $relations = [])
    {
        return $this->connection()->query()->with($relations)->where('id', $id)->first();
    }

    public function getDataByUuid($uuid, array $relations = [])
    {
        return $this->connection()->query()->with($relations)->where('uuid', $uuid)->first();
    }

    public function getFirstOnly(array $relations = [])
    {
        return $this->connection()->query()->with($relations)->first();
    }

    public function getLatest(array $options = [], array $relations = [])
    {
        return $this->optionsQuery($options)->with($relations)->latest()->first();
    }

    public function insert(array $data)
    {
        return $this->connection()->query()->create($data);
    }

    public function update(array $data, int $id): int
    {
        return $this->connection()->query()->find($id)->update($data);
    }

    public function updateByOptions(array $data, array $options = []): int
    {
        return $this->optionsQuery($options)->update($data);
    }

    public function increment($amount, $column, int $id): int
    {
        return $this->connection()->query()->where('id', $id)
            ->increment($column, $amount);
    }

    public function decrement($amount, $column, int $id): int
    {
        return $this->connection()->query()->where('id', $id)
            ->decrement($column, $amount);
    }

    public function incrementByUuid($amount, $column, $uuid): int
    {
        return $this->connection()->query()->where('uuid', $uuid)
            ->increment($column, $amount);
    }

    public function updateWithIds(array $data, array $ids): int
    {
        return $this->connection()->query()->whereIn('id', $ids)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->connection()->query()->find($id)->delete();
    }

    public function forceDestroy(int $id)
    {
        return $this->connection()->query()->find($id)->forceDelete();
    }

    public function destroyWithIds(array $ids): mixed
    {
        return $this->connection()->query()->whereIn('id', $ids)->delete();
    }

    public function destroyByOptions(array $options): mixed
    {
        return $this->optionsQuery($options)->delete();
    }

    abstract public function connection(): Model;
}
