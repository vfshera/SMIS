<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{


    public function allsubjects(){
        $subjects = Subject::orderBy('id', 'DESC')->paginate(10);

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
                $subjct = Subject::findOrFail($request->input('id'));
                $subjct->title = $request->input('title');
                $subjct->abbreviation = $request->input('abbreviation');
                $subjct->description = $request->input('description');

                $subjct->save();

                return json_encode("Subject Updated Successfully");

            } else {

                $newForm = Subject::create($data);

                return json_encode("Subject Created Successfully");
            }


    }

    public function destroy($id)
    {
        $sub = Subject::findOrFail($id);

        $sub->delete();

        return json_encode("Subject Deleted Successfully");
    }
}
