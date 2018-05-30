<?php

namespace App\Jobs;

use App\Message;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payload = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     * @param Message $model
     */
    public function handle(Message $model)
    {
        Log::debug('Processing import message job', ['payload' => $this->payload]);
        $model = $model->create([
            'uid'     => $this->payload->uid,
            'sender'  => $this->payload->sender,
            'subject' => $this->payload->subject,
            'content' => $this->payload->message,
            'sent_at' => Carbon::createFromTimestamp($this->payload->time_sent),
        ]);

        Log::info('Message saved successfully', ['id' => $model->id]);
    }
}
