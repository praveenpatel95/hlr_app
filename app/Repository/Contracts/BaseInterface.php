<?php

namespace App\Repository\Contracts;

interface BaseInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function deleteById(int $id);
}
