<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StudyResource;
use App\Study;

class StudiesController extends Controller
{
    public function getStudentStudy($id){
        $studies = Study::where('student_id', $id)->get();
        return StudyResource::collection( $studies);
    }
    public function store(Request $request)
    {
        $data =  request()->validate([
            'student_id' => 'required',
            'timetable_id' => 'required',
        ]);
            $match = Study::where('student_id', $request->student_id)->where('timetable_id', $request->timetable_id)->get();

            if($match->count() > 0){
                return json_encode("Duplicate Subject Choosen");
            }else{
                Study::create($data);
                return json_encode("Study Created Successfully");
            }
    }

    public function destroy($id){

        $study = Study::find($id);

        $study->delete();

        return json_encode(['message'=>'Study Deleted Successfully']);
    }
}
