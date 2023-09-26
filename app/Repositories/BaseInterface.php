<?php

namespace App\Repositories;

interface BaseInterface
{
    public function index();

    public function store(array $data, $img);

    public function edit($id);

    // public function edit($id);

    public function update(array $data, $id);

    public function delete($id);
}
