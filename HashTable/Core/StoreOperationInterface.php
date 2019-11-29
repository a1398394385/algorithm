<?php

namespace HashTable\Core;

interface StoreOperation
{

    public function create($key, $value);

    public function delete($key);

    public function update($key, $value);

    public function search($key);

    public function allData();
}
