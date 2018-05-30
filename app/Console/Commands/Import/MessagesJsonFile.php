<?php

namespace App\Console\Commands\Import;

use App\Jobs\ImportMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MessagesJsonFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:messages {file=storage/app/import_messages.json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import messages into database from json file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $fileLocation = $this->argument('file');
        Log::debug('Started import messages to database');
        if (!file_exists($fileLocation)) {
            Log::error('Failed to import messages', ['error' => 'file does not exists', 'file' => $fileLocation]);
            $this->error('File does not exists');
            return;
        }

        $this->line('File located: ' . $fileLocation);

        $fileContents = file_get_contents($fileLocation);
        $result       = json_decode($fileContents);
        if (json_last_error()) {
            Log::error('Failed to import messages', ['error' => 'invalid json', 'json_error' => json_last_error_msg(), 'file_contents' => $fileContents]);
            $this->error('Invalid json');
            return;
        }

        if (!isset($result->messages)) {
            Log::error('Invalid JSON structure', ['error' => 'missing messages property', 'decoded_json' => $result]);
            $this->error('Invalid json structure: missing messages property');
            return;
        }

        $this->line('Importing');
        $bar = $this->output->createProgressBar(count($result->messages));
        foreach ($result->messages as $message) {
            $job = new ImportMessage($message);
            dispatch($job);
            Log::debug('dispatched message to import into database', ['message' => $message]);
            $bar->advance();
        }
        $bar->finish();
        Log::debug('Finished import messages');
    }
}
