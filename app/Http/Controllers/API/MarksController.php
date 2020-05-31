<?php

namespace App\Http\Controllers\API;

use App\Mark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarksController extends Controller
{
    public function store(Request $request)
    {
           $data = request()->validate([
                'student_id' => 'required',
                'duty_id' => 'required',
                'score' => 'required',
            ]);

           $mark = Mark::where('duty_id',request()->input('duty_id'))->where('student_id',request()->input('student_id'));

           if($mark){

               $mark->delete();
               Mark::create($data);

           }else{
               Mark::create($data);
           }

            return json_encode("Marks Updated Successfully");

   }

    public function destroy($id){

        $mark = Mark::findOrFail($id);

        $mark->delete();

        return json_encode(['message'=>'Marks Deleted Successfully']);
    }
}
