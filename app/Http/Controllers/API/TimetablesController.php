<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimetableResource;
use App\Timetable;
use Illuminate\Http\Request;

class TimetablesController extends Controller
{

    public function index()
    {
        $timetables = Timetable::orderBy('created_at' , 'DESC')->get();

        return TimetableResource::collection($timetables);
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
