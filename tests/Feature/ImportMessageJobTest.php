<?php

namespace Tests\Feature;

use App\Jobs\ImportMessage;
use App\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportMessageJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMessageImport()
    {
        $json   = '{"uid": "21","sender": "Ernest Hemingway","subject": "animals","message": "This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","time_sent": 1459239867}';
        $result = json_decode($json);
        $job    = new ImportMessage($result);
        $job->handle(new Message());
        $this->assertDatabaseHas('messages', ['uid' => $result->uid]);
    }
}
