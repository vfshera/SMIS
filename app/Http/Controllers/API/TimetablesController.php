<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimetableResource;
use App\Term;
use App\Timetable;
use Illuminate\Http\Request;

class TimetablesController extends Controller
{

    public function index()
    {
        $timetables = Timetable::orderBy('created_at' , 'DESC')->get();

        $currTerm = Term::where('status', '1')->first();
        $currentTables = [];

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

    public function classSubjects($id){
        $sub = Timetable::where('class_id', $id)->orderBy('created_at' , 'DESC')->get();
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

    public function destroy($id)
    {
        //
    }
}
