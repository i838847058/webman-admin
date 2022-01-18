<?php

namespace Shx\Admin\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected static $defaultName = 'admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected static $defaultDescription = 'List all admin commands';

    /**
     * @var string
     */
    public static $logo = <<<LOGO
 __        __   _                                           _           _       
 \ \      / /__| |__  _ __ ___   __ _ _ __         __ _  __| |_ __ ___ (_)_ __  
  \ \ /\ / / _ \ '_ \| '_ ` _ \ / _` | '_ \ _____ / _` |/ _` | '_ ` _ \| | '_ \ 
   \ V  V /  __/ |_) | | | | | | (_| | | | |_____| (_| | (_| | | | | | | | | | |
    \_/\_/ \___|_.__/|_| |_| |_|\__,_|_| |_| shx  \__,_|\__,_|_| |_| |_|_|_| |_|
                                                                          
LOGO;

    /**
     * Execute the console command.
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(static::$logo);
        $output->writeln(Admin::getLongVersion());

        $this->comment('');
        $this->comment('Available commands:');

        $this->listAdminCommands($output);
    }

    /**
     * List all admin commands.
     *
     * @return void
     */
    protected function listAdminCommands(OutputInterface $output)
    {
        $commands = collect(Artisan::all())->mapWithKeys(function ($command, $key) {
            if (Str::startsWith($key, 'admin:')) {
                return [$key => $command];
            }

            return [];
        })->toArray();

        $width = $this->getColumnWidth($commands);

        /** @var Command $command */
        foreach ($commands as $command) {
            $output->writeln(sprintf(" %-{$width}s %s", $command->getName(), $command->getDescription()));
        }
    }

    /**
     * @param (Command|string)[] $commands
     *
     * @return int
     */
    private function getColumnWidth(array $commands)
    {
        $widths = [];

        foreach ($commands as $command) {
            $widths[] = static::strlen($command->getName());
            foreach ($command->getAliases() as $alias) {
                $widths[] = static::strlen($alias);
            }
        }

        return $widths ? max($widths) + 2 : 0;
    }

    /**
     * Returns the length of a string, using mb_strwidth if it is available.
     *
     * @param string $string The string to check its length
     *
     * @return int The length of the string
     */
    public static function strlen($string)
    {
        if (false === $encoding = mb_detect_encoding($string, null, true)) {
            return strlen($string);
        }

        return mb_strwidth($string, $encoding);
    }
}
