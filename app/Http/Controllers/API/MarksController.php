<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ResultsResource;
use App\Http\Resources\TermInResultsResource;
use App\Jobs\SendResults;
use App\Mail\ResultsMail;
use App\Mark;
use App\Student;
use App\Study;
use App\Term;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MarksController extends Controller
{
    public function sendResults(Request $request){
       $students = Student::all();
       $term = Term::findOrFail($request->term_id);

       $results = [];
       if($term->status == 0 && $term->submissions == 0){
           foreach ($students as $student){
               $marks = Mark::where('student_id', $student->id)->where('term_id' , $term->id)->orderBy('created_at' , 'DESC')->get();

               array_push($results , ['details' => ['primary' => User::findOrFail($student->user_id) , 'secondary' => $student ], 'resultslip' =>  ResultsResource::collection($marks)]);
           }
       }
            // send text and email here
            foreach ($results as $result){
                $this->dispatch(new SendResults($result));
            }
       return json_encode("Sending Results....");
    }

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
