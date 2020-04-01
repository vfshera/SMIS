<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{


    public function allsubjects(){
        $subjects = Subject::orderBy('created_at', 'DESC')->paginate(10);

        return json_encode($subjects);
    }

    public function store(Request $request)
    {

        $data =  request()->validate([
                'title' => 'required',
                'abbreviation' => 'required|max:7|min:2',
                'description' => 'required',
             ]);

             if($request->has('id')){

                $subjct = Subject::find($request->input('id'));
                $subjct->title = $request->input('title');
                $subjct->abbreviation = $request->input('abbreviation');
                $subjct->description = $request->input('description');

                $subjct->save();

                return json_encode("Class Updated Successfully");

            } else {

                $newForm = Subject::create($data);

                return json_encode("Class Created Successfully");
            }


    }

    public function destroy($id)
    {
        $subject = Subject::find($id);


        // $subject->delete();

        return json_encode(dd($subject));
    }
}
