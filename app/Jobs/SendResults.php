<?php

namespace App\Jobs;

use App\Mail\ResultsMail;
use App\SMS\Smsservice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use AfricasTalking\SDK\AfricasTalking;

class SendResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $result = [];
        /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->result = $result;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sendSms = new Smsservice($this->result);
        $sendSms->sendResults();

        Mail::to($this->result["student"]["email"])->send(new ResultsMail($this->result));
    }
}
