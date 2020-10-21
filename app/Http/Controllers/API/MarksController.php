<?php

namespace App\Http\Controllers\API;


use AfricasTalking\SDK\AfricasTalking;
use App\Http\Resources\ResultsResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TermInResultsResource;
use App\Jobs\SendResults;
use App\Mark;
use App\Student;
use App\Term;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarksController extends Controller
{
    public function sendResults(Request $request){
       $students = StudentResource::collection(Student::all());
       $term = Term::findOrFail($request->term_id);

       $results = [];
       if($term->status == 0 && $term->submissions == 0){
           foreach ($students as $student){
               $marks = Mark::where('student_id', $student->id)->where('term_id' , $term->id)->orderBy('created_at' , 'DESC')->get();

               array_push($results , ['student' => User::findOrFail($student->user_id) ,'details' =>  json_decode(json_encode($student)),  'resultslip' => json_decode(json_encode(ResultsResource::collection($marks))) ]);
           }
       }
            $data =[];
            // send text and email here
            foreach ($results as $result){
                $data = $result;
                $this->dispatch(new SendResults($result));
            }

            //START AFRICAS TALKING
            $username = env('AT_USERNAME','sandbox');
            $apiKey   = env('AT_API_KEY','NOKEY');
            $number = '+254700080373';

            $smsHead = 'Dear Parent,'."\n".'Here Are the results of your child for TERM  '
                .$data["resultslip"][0]->term->name.' '.$data["resultslip"][0]->term->year
                ."\n".$data["details"]->name.'  Adm No  '.$data["details"]->admission_no.'  Form '.$data["details"]->class_name;
            $smsBody = '';

            foreach ($data["resultslip"] as $subjectScore){
                $smsBody .=  $subjectScore->subject." ". $subjectScore->score.' ,  ';
            }

            $message = $smsHead."\n".$smsBody."\n"."Examinations Office \n MURRAY GIRLS HIGH SCHOOL";

            $AT  = new AfricasTalking($username,  $apiKey);
            $sms = $AT->sms();

          $info =  $sms->send([
                'to'      => $number,
                'message' => $message
            ]);
                //END AFRICAS TALKING
            return $results;
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
