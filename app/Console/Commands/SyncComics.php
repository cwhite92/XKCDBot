<?php

namespace App\Console\Commands;

use App\Comic;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateComics extends Command
{
    protected $signature = 'xkcd:update';
    protected $description = 'Syncs local comics with XKCD comics';

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
     * @return mixed
     */
    public function handle()
    {
        $this->log('Starting comic sync');

        $id = 1;
        while (true) {
            if ($id === 404) {
                $id++;
                continue;
            }

            if (Comic::where('xkcd_id', $id)->exists()) {
                $this->log("Comic $id exists, skipping");
                $id++;
                continue;
            }

            $this->log("Requesting comic $id");

            $json = @file_get_contents(sprintf('https://xkcd.com/%s/info.0.json', $id));

            if (! $json) {
                $this->log("Comic $id doesn't seem to exist, stopping");
                break;
            }

            $json = json_decode($json, true);

            Comic::create([
                'xkcd_id' => $json['num'],
                'title' => $json['title'],
                'transcript' => $json['transcript'],
                'alt' => $json['alt'],
                'image' => $json['img'],
                'published_at' => new Carbon(sprintf('%s-%s-%s', $json['year'], $json['month'], $json['day']))
            ]);

            $id++;
        }

        $this->log('Finished syncing comics');
    }

    private function log(string $message) {
        Log::info($message);
        $this->info($message);
    }
}
