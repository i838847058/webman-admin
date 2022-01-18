<?php

namespace Shx\Admin\Console;

use Shx\Admin\Facades\Admin;
use Illuminate\Console\Command;

class MenuCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected static $defaultName = 'admin:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected static $defaultDescription = 'Show the admin menu';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $menu = Admin::menu();

        echo json_encode($menu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\r\n";
    }
}
