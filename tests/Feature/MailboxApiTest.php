<?php

namespace Tests\Feature;

use App\Message;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MailboxApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicUsage()
    {
        factory(User::class, 1)->create();
        $user = User::find(1);
        $this->be($user);
        factory(Message::class, 5)->create();

        $result = $this->json('get', route('messages.index'));
        $this->assertTrue(count($result->json()['data']) === 5);

        $result = $this->json('get', route('archived.index'));
        $this->assertTrue(count($result->json()['data']) === 0);

        $result  = $this->json('get', route('messages.show', [1]));
        $message = Message::find(1);
        $this->assertNotEmpty($result->json()['data']);
        $this->assertTrue($message->subject == $result->json()['data']['subject']);

        $this->assertNull($result->json()['data']['read_at']);
        $result = $this->json('post', route('message.read', [1]));
        $this->assertNotNull($result->json()['data']['read_at']);

        $this->assertNull($result->json()['data']['archived_at']);
        $result = $this->json('post', route('message.archive', [1]));
        $this->assertNotNull($result->json()['data']['archived_at']);

        $result = $this->json('get', route('archived.index'));
        $this->assertTrue(count($result->json()['data']) === 1);

    }
}
