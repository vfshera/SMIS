<?php

namespace App\Http\Controllers\API;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClasslistResource;
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

            if($request->has('id')){

                $classrm = Classroom::findOrFail($request->input('id'));
                $classrm->form_id = $request->input('form_id');
                $classrm->stream_id = $request->input('stream_id');

                $classrm->save();

                return json_encode("Class Updated Successfully");
            } else {
                $newForm = Classroom::create($data);

                return json_encode("Class Created Successfully");
            }


    }

    public function getClass($id){

        $thisclass = Classroom::find($id);

        return new ClasslistResource($thisclass);
    }
}
