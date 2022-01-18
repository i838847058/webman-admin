<?php

namespace Shx\Admin\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected static $defaultName = 'admin:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected static $defaultDescription = "re-publish laravel-admin's assets, configuration, language and migration files. If you want overwrite the existing files, you can add the `--force` option";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $force = $this->option('force');
        $options = ['--provider' => 'Shx\Admin\AdminServiceProvider'];
        if ($force == true) {
            $options['--force'] = true;
        }
        $this->call('vendor:publish', $options);
        $this->call('view:clear');
    }
}
