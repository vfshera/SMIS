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



            $newForm = Subject::create($data);

            return json_encode($newForm);


    }
}
