<?php

class SyncXkcd
{
    const URL = 'http://xkcd.com/%s/info.0.json';
    const COMICS_PATH = '%s/../storage/%s.json';

    public function run()
    {
        echo "Starting XKCD sync\n";
        $id = 1;

        while (true) {
            if ($id === 404) {
                echo "Skipping 404 for obvious reasons...\n";
                $id++;
                continue;
            }

            if (file_exists(sprintf(self::COMICS_PATH, __DIR__, $id))) {
                echo "Comic $id exists, skipping\n";
                $id++;
                continue;
            }

            echo "Requesting comic $id\n";

            $json = @file_get_contents(sprintf(self::URL, $id));

            if (!$json) {
                echo "Comic $id doesn't seem to exist, stopping\n";
                break;
            }

            file_put_contents(sprintf(self::COMICS_PATH, __DIR__, $id), $json);
            $id++;
        }

        echo "Finished\n";
    }
}

$class = new SyncXkcd();
$class->run();