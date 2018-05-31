<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReadMessageController extends Controller
{
    public function __invoke(Message $message)
    {
        Log::debug('Received request to set message read');
        $message->read_at = Carbon::now();
        $message->save();
        Log::info('Message read');
        return new MessageResource($message);
    }
}
