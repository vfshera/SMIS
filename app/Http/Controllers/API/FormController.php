<?php

namespace App\Http\Controllers\API;

use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function GuzzleHttp\json_encode;

class FormController extends Controller
{
    public function allforms(){
        $frms = Form::orderBy('created_at', 'DESC')->paginate(10);

        return json_encode($frms);
    }

    public function store(Request $request)
    {

        $data =  request()->validate([
                'name' => 'required',
                'math_rep' => 'required',
             ]);



            $newForm = Form::create($data);

            return json_encode($newForm);


    }
}
