<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeachersResource;
use App\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{


    public function getTeachers(){

        $teachers = Teacher::orderBy('created_at', 'DESC')->paginate(10);


        return TeachersResource::collection($teachers);
    }

    public function store(Request $request)
    {
             if($request->has('id')){
                    request()->validate([
                        'tsc_number' => 'required',
                        'tel' => 'required',
                        'address' => 'required',
                        'town' => 'required',
                        'county' => 'required',
                    ]);


                    $tcher = Teacher::findOrFail($request->input('id'));


                    $tcher->tsc_number = request()->input('tsc_number');
                    $tcher->tel = request()->input('tel');
                    $tcher->address = request()->input('address');
                    $tcher->town = request()->input('town');
                    $tcher->county = request()->input('county');

                    $tcher->save();

                    return json_encode("Teacher Updated Successfully");


            } else{
                $matching = Teacher::where('user_id', request()->input('user_id'))->first();
                if($matching)
                {
                    return json_encode('Teacher Already Exists');

                }else{
                   $newTcher = request()->validate([
                        'user_id' => 'required',
                        'tsc_number' => 'required',
                        'tel' => 'required',
                        'address' => 'required',
                        'town' => 'required',
                        'county' => 'required',
                    ]);

                    Teacher::create($newTcher);

                    return json_encode("Teacher Created Successfully");
                }
            }
    }

    public function destroy($id){

        $tch = Teacher::find($id);


        $tch->delete();

        return json_encode(['message'=>'Teacher Deleted Successfully']);
    }
}
