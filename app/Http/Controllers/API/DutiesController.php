<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Duty;

use App\Http\Resources\SubjectsResource;
class DutiesController extends Controller
{
    public function getDuties(){
        $duties = Duty::orderBy('subject_id' , 'DESC')->get();
         return SubjectsResource::collection( $duties);
    }

    public function getTeacherDuties($teacherID){
        $tduties = Duty::where('teacher_id', $teacherID)->get();
         return SubjectsResource::collection( $tduties);
    }
    public function store(Request $request)
    {
               $data =  request()->validate([
                    'teacher_id' => 'required',
                    'subject_id' => 'required',
                ]);
             if($request->has('id')){

                    $duty = Duty::findOrFail($request->input('id'));


                    $duty->teacher_id = request()->input('teacher_id');
                    $duty->subject_id = request()->input('subject_id');

                    $duty->save();

                    return json_encode("Duty Updated Successfully");

            } else{

                Duty::create($data);

                return json_encode("Duty Created Successfully");
            }
    }

    public function destroy($id){

        $duty = Duty::find($id);


        $duty->delete();

        return json_encode(['message'=>'Duty Deleted Successfully']);
    }
}
