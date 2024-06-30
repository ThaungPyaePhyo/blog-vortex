<?php

namespace App\Api\Foundation\Repository;

interface EloquentRepositoryInterface
{
    public function all(array $options = []);

    public function getDataById(int $id, array $relations = []);


    public function insert(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);

}
