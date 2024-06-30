<?php

namespace App\Api\Foundation\Repository;

interface EloquentRepositoryInterface
{
    public function all(array $options = []);

    public function getDataById(int $id, array $relations = []);

    public function getDataByUuid($uuid, array $relations = []);

    public function getFirstOnly(array $relations = []);

    public function getLatest(array $options = [], array $relations = []);

    public function insert(array $data);

    public function update(array $data, int $id);

    public function updateByOptions(array $data, array $options = []);

    public function increment($amount, $column, int $id);

    public function decrement($amount, $column, int $id);

    public function incrementByUuid($amount, $column, $uuid);

    public function updateWithIds(array $data, array $ids);

    public function getDataByOptions(array $options = []);

    public function destroy(int $id);

    public function forceDestroy(int $id);

    public function destroyWithIds(array $ids);

    public function destroyByOptions(array $options);

}
