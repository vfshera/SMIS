<?php

namespace App\Http\Controllers\API;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{

    public function allclasses(){
        $classes = Classroom::orderBy('created_at', 'DESC')->paginate(10);

        return ClassroomResource::collection($classes);
    }

    public function store(Request $request)
    {

        $data =  request()->validate([
                'form_id' => 'required',
                'stream_id' => 'required',
             ]);



            $newForm = Classroom::create($data);

            return json_encode($newForm);


    }
}
