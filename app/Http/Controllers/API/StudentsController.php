<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Student;

class StudentsController extends Controller
{
    public function students(){

        $students = Student::orderBy('created_at', 'DESC')->paginate(10);


        return StudentResource::collection($students);
    }

    public function store(Request $request)
    {
         request()->validate([
                'user_id' => 'required',
                'parents_fname' => 'required',
                'parents_sname' => 'required',
                'parents_tel' => 'required',
                'class_id' => 'required',
                'address' => 'required',
                'town' => 'required',
                'county' => 'required',
             ]);

          $matching = Student::where('user_id', request()->input('user_id'))->first();
            if($matching)
            {
                return json_encode('Cant Insert');

            }else{

                $st = new Student();
                $st->user_id = request()->input('user_id');
                $st->parents_fname = request()->input('parents_fname');
                $st->parents_sname = request()->input('parents_sname');
                $st->parents_tel = request()->input('parents_tel');
                $st->class_id = request()->input('class_id');
                $st->address = request()->input('address');
                $st->town = request()->input('town');
                $st->county = request()->input('county');

                $st->save();
            }
    }

    public function destroy($id){

        $student = Student::find($id);


        $student->delete();

        return json_encode(['message'=>'Deleted Successfully']);
    }
}
