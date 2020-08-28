<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AppMakeApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-api {name} {--P|pivot : Generate pivot model without policy and resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate model, factory, resource, policy and migration';

    /**
     * Generate model, factory, resource, policy and migration.
     *
     * @return int
     */
    public function handle()
    {
        $strHandle = Str::of($this->argument('name'))->ucfirst();
        $pivot = $this->option('pivot');
        $modelName = $pivot ? $strHandle->prepend('Models/Pivots/') : $strHandle->prepend('Models/');

        $this->call('make:model', [
            'name' => (string) $modelName,
            '--factory' => true,
            '--migration' => true,
            '--pivot' => $pivot,
        ]);

        if (!$pivot) {
            $this->call('make:resource', [
                'name' => (string) $strHandle->append('Resource'),
            ]);

            $this->call('make:policy', [
                'name' => (string) $strHandle->append('Policy'),
                '--model' => (string) $modelName,
            ]);
        }

        return 0;
    }
}
