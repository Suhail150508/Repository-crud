<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class TestRepository1 extends BaseRepository implements TestInterface
{
    protected $model;
    public function __construct(Student $model)
    {
        $this->model = $model;
    }

}
