<?php

namespace Murdercode\LaravelShortcodePlus\Commands;

use Illuminate\Console\Command;

class LaravelShortcodePlusCommand extends Command
{
    public $signature = 'laravel-shortcode-plus';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
