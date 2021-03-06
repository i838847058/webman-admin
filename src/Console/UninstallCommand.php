<?php

namespace Shx\Admin\Console;

use Illuminate\Console\Command;

class UninstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected static $defaultName = 'admin:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected static $defaultDescription = 'Uninstall the admin package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->confirm('Are you sure to uninstall laravel-admin?')) {
            return;
        }

        $this->removeFilesAndDirectories();

        $this->line('<info>Uninstalling laravel-admin!</info>');
    }

    /**
     * Remove files and directories.
     *
     * @return void
     */
    protected function removeFilesAndDirectories()
    {
        $this->laravel['files']->deleteDirectory(config('admin.directory'));
        $this->laravel['files']->deleteDirectory(public_path('vendor/laravel-admin/'));
        $this->laravel['files']->delete(config_path('admin.php'));
    }
}
