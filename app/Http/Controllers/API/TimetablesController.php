<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimetableResource;
use App\Study;
use App\Term;
use App\Timetable;
use Illuminate\Http\Request;

class TimetablesController extends Controller
{

    public function index()
    {
        $currTerm = Term::where('status', '1')->first();

       if(!empty($currTerm)){
           $timetables = Timetable::where('term_id' , $currTerm->id)->orderBy('created_at' , 'DESC')->get();

        }

        if(!empty($timetables)){
            return TimetableResource::collection($timetables);
        } else {

        }
    }

    public function classSubjects($cid,$sid){
        $currTerm = Term::where('status', '1')->first();
        $already = Study::where('student_id', $sid)->pluck('timetable_id');

        $sub = Timetable::where('class_id', $cid)->where('term_id' , $currTerm->id)->orderBy('created_at' , 'DESC')->get();

        return TimetableResource::collection( $sub);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'class_id' => 'required',
            'term_id' => 'required',
            'duty_id' => 'required',
            'day' => 'required',
            'time' => 'required',
        ]);
            Timetable::create($data);

            return json_encode("Timetable Created Successfully");
    }

    public  function update($id){
        $tbl = Timetable::findOrFail($id);
        $tbl->update(['duty_id' => \request()->dutyId]);
    }
    public function destroy($id)
    {
        //
    }
}
