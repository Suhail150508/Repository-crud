<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BaseRepository
{
    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return Student::all();
    }

    // public function indexid($id)
    // {
    //     return 'something';
    // }

    public function store($data, $img)
    {
        $post = $data->all();
        if ($post['image']) {
            $file = $post['image'];
            $directory = 'imagesss';
            $filename = Str::random(10) . '_' . uniqid() . '.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            $path = $directory . '/' . $filename;
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0775, true, true);
            }

            $image_parts = explode(";base64,", $file);
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($path, $image_base64);


            $post['image'] = 'http://localhost:8000/' . $path;
        }
        $this->model::create($post);
    }


    public function edit($id)
    {
     $edit = $this->model::find($id);
     dd($edit);
     return response()->json($edit);
        // if ($edit) {

        //     return response()->json([
        //         'status' => 202,
        //         'message' => 'update successfully'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'not found student'
        //     ]);
        // }
        }
    

    public function update($data, $id)
    {

        //    $data = $this->model::find($id);
        $post =  $this->model::find($id);
        $data = $data->all();
        // Handle the base64-encoded image and store it in a unique file
        if ($data['image']) {
            $file = $data['image'];
            // dd( $file);
            $directory = 'imagesss';
            $filename = Str::random(10) . '_' . uniqid() . '.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            $path = $directory . '/' . $filename;
            if (!File::exists($directory)) {
                File::delete($directory, 0775, true, true);
            }

            $image_parts = explode(";base64,", $file);
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($path, $image_base64);


            $data['image'] = 'http://localhost:8000/' . $path;

            $post->update($data);

            //     $update->update();
            return response()->json([
                'status' => 200,
                'message' => 'update successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'not found student'
            ]);
        }
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $delete = $student->delete();
        if ($delete) {
            return response()->json([
                'status' => 200,
                'message' => 'deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'not found student'
            ]);
        }
    }
}
