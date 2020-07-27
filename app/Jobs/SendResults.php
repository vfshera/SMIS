<?php

namespace App\Jobs;

use App\Mail\ResultsMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $result = [];
    private $username;
    private $apiKey;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->result = $result;
        $this->username = config("africastalking.username");
        $this->apiKey = config("africastalking.api_key");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //send sms
        $AT = new AfricasTalking($this->username, $this->apiKey);
        $sms = $AT->sms();
        try {
             $result = $sms->send([
                'to'      => '+254700080373',
                'message' => 'SMIS TALKING BRUH'
            ]);

             dd($result);

        } catch (Exception $e) {
            dd("Error: ".$e.getMessage());
        }

        //send email
        Mail::to($this->result["student"]["email"])->send(new ResultsMail($this->result));
    }
}
