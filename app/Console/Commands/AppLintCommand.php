<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class AppLintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:lint {--F|fix : Fix the code with phpcbf}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint application code with PHP_CodeSniffer';

    /**
     * Lint application directory with phpcs or fix with phpcbf.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('fix')) {
            $fixProcess = new Process([
                base_path('vendor/bin/phpcbf'),
                './app',
            ]);

            $this->info(trans('console.lint.running-phpcbf'));

            $fixProcess->run();

            $fixProcessOutput = trim($fixProcess->getOutput());
            $this->comment($fixProcessOutput);

            return $fixProcess->isSuccessful() ? 0 : 1;
        }

        $lintProcess = new Process([
            base_path('vendor/bin/phpcs'),
            './app',
            '-w',
            '--no-colors',
        ]);

        $this->info(trans('console.lint.running-phpcs'));

        $lintProcess->run();

        if ($lintProcess->isSuccessful()) {
            $this->info(trans('console.lint.phpcs-success'));
            return 0;
        }

        $lintProcessOutput = trim($lintProcess->getOutput());
        $this->comment($lintProcessOutput);

        return 1;
    }
}
