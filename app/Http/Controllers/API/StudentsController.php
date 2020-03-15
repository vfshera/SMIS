<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use APp\Student;

class StudentsController extends Controller
{
    public function store(Request $request)
    {

         request()->validate([
                's_id' => 'required',
                'parents_fname' => 'required',
                'parents_sname' => 'required',
                'parents_tel' => 'required',
                'class_id' => 'required',
                'address' => 'required',
                'town' => 'required',
                'county' => 'required',
             ]);



        // $st = new Student();
        // $st->s_id = request()->input('s_id');
        // $st->admission = request()->input('#');
        // $st->parents_fname = request()->input('parents_fname');
        // $st->parents_sname = request()->input('parents_sname');
        // $st->parents_tel = request()->input('parents_tel');
        // $st->class_id = request()->input('class_id');
        // $st->address = request()->input('address');
        // $st->town = request()->input('town');
        // $st->county = request()->input('county');



    }
}
