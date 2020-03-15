<?php

namespace App\Http\Controllers\API;

use App\Form;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormResource;
use Illuminate\Http\Request;

use function GuzzleHttp\json_encode;

class FormController extends Controller
{
    public function allforms(){
        $frms = Form::orderBy('created_at', 'DESC')->paginate(10);

        return FormResource::collection($frms);
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
