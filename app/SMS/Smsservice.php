<?php


namespace App\SMS;

use AfricasTalking\SDK\AfricasTalking;

class Smsservice
{
    private $username;
    private $apiKey;
    private $message;
    private $number;

    public function __construct($data)
    {
        $this->username = env('AT_USERNAME','sandbox');
        $this->apiKey   = env('AT_API_KEY','NOKEY');
        $this->number = $data["details"]->parents_tel;

        $smsHead = 'Dear Parent, '.' \n'.'Here Are the results of your child for TERM  '
                    .$data["resultslip"][0]->term->name.' '.$data["resultslip"][0]->term->year
                    .'\n '.$data["details"]->name.'  Adm No  '.$data["details"]->admission_no.'  Form '.$data["details"]->class_name;
        $smsBody = '';

        foreach ($data["resultslip"] as $subjectScore){
            $smsBody .=  $subjectScore->subject." ". $subjectScore->score.' , ';
        }

        $this->message = $smsHead." \n".$smsBody."\n "."Examinations Office ". "\n "." Murray Girls High School";
    }

    public function sendResults(){
        $AT  = new AfricasTalking($this->username,  $this->apiKey);
        $sms = $AT->sms();

        $sms->send([
            'to'      => $this->number,
            'message' => $this->message
        ]);

    }

}
