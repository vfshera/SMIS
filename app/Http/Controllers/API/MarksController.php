<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ResultsResource;
use App\Http\Resources\TermInResultsResource;
use App\Mark;
use App\Student;
use App\Study;
use App\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarksController extends Controller
{
    public function results(){
        $student_id = Student::where('user_id',auth()->user()->id)->get()->first()->pluck('id');
        $marks = Mark::where('student_id', $student_id)->orderBy('created_at' , 'DESC')->get();
        $terms = Term::all();
        $sortedMarks = [];


             foreach ($terms as $term){
                 $termResults = [];

                if($term->status == 0){
                    foreach ($marks as $mark){
                        if($term->id == $mark->term_id){
                            array_push($termResults , $mark);
                        }
                    }
                }

                 array_push($sortedMarks , ['term' => new TermInResultsResource($term), 'results' => ResultsResource::collection($termResults)] );
             }

        return json_encode($sortedMarks);
    }

    public function store(Request $request)
    {
           $data = request()->validate([
                'student_id' => 'required',
                'duty_id' => 'required',
                'score' => 'required',
               'term_id' => 'required'
            ]);

           $mark = Mark::where('duty_id',request()->input('duty_id'))->where('student_id',request()->input('student_id'))->where('term_id', request()->input('term'));

           if($mark){

               $mark->delete();
               Mark::create($data);

           }else{
               Mark::create($data);
           }

            return json_encode("Marks Updated Successfully");

   }

    public function destroy($id){

        $mark = Mark::findOrFail($id);

        $mark->delete();

        return json_encode(['message'=>'Marks Deleted Successfully']);
    }
}
