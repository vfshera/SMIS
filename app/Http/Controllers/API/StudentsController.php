<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentInfoResource;
use App\Http\Resources\TimetableResource;
use App\Term;
use App\Timetable;
use Illuminate\Http\Request;
use App\Student;

class StudentsController extends Controller
{
    public function myInfo(){

        return new StudentInfoResource(Student::where('user_id', auth()->user()->id)->first());

    }

    public function myTimetable(){

        $stud = Student::where('user_id', auth()->user()->id)->first();

        $timetables = Timetable::where('class_id' , $stud->class_id)->get();
        $currentTables = [];
        $currTerm = Term::where('status', '1')->first();

            foreach ($timetables as $tble){

                if($tble->term->id == $currTerm->id){
                    array_push($currentTables,$tble);
                }
            }

           if(!empty($currentTables)){
               return TimetableResource::collection($currentTables);
           } else {

           }
    }

    public function myResults(){

    }

    public function students(){

        $students = Student::orderBy('created_at', 'DESC')->paginate(10);


        return StudentResource::collection($students);
    }

    public function store(Request $request)
    {
             if($request->has('id')){
                    request()->validate([
                        'parents_fname' => 'required',
                        'parents_sname' => 'required',
                        'parents_tel' => 'required',
                        'class_id' => 'required',
                        'address' => 'required',
                        'town' => 'required',
                        'county' => 'required',
                    ]);


                    $std = Student::findOrFail($request->input('id'));

                    $std->parents_fname = request()->input('parents_fname');
                    $std->parents_sname = request()->input('parents_sname');
                    $std->parents_tel = request()->input('parents_tel');
                    $std->class_id = request()->input('class_id');
                    $std->address = request()->input('address');
                    $std->town = request()->input('town');
                    $std->county = request()->input('county');

                    $std->save();

                    return json_encode("Student Updated Successfully");

                 }else{
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
    }

    public function destroy($id){

        $student = Student::find($id);


        $student->delete();

        return json_encode(['message'=>'Deleted Successfully']);
    }
}
