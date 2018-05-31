<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ArchiveMessageController extends Controller
{
    public function __invoke(Message $message)
    {
        Log::debug('Received request to archive message');
        $message->archived_at = Carbon::now();
        $message->save();
        Log::info('Message archived');
        return new MessageResource($message);
    }
}
