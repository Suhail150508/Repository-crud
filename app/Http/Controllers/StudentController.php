<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Student;
use App\Repositories\TestRepository1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Stringable;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Component\HttpKernel\Event\ResponseEvent;


class StudentController extends Controller
{
    protected $test;
    public function __construct(TestRepository1 $test)
    {
        $this->test = $test;
    }

    public function index()
    {
        $students = $this->test->index();
        return response()->json($students);
    }

    public function edit($id)
    {
        
        $this->test->edit($id);

        // return response()->json($students);
    }

    public function store(Request $request)
    {
        $img = $request->image;
        $data = request();
        // $data->merge(['image' => null]);
        $this->test->store($data, $img);
        //  $img
        // );
    }

    // public function edit($id)
    // {
    //     $this->test->in($id);
    // }
    public function update(Request $request, $id)
    {
        $data = request();
        $this->test->update($data, $id);
    }

    public function delete($id)
    {
        $this->test->delete($id);
    }
}
