<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Stream;
use Illuminate\Http\Request;

class StreamsController extends Controller
{

    public function allstreams(){
        $strms = Stream::orderBy('created_at', 'DESC')->paginate(10);

        return json_encode($strms);
    }

    public function store(Request $request)
    {

        $data =  request()->validate([
                'name' => 'required',
                'rep' => 'required',
             ]);



            $newForm = Stream::create($data);

            return json_encode($newForm);


    }
}
