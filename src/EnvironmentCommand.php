<?php

namespace AVASTechnology\LaravelEnvironment;

use Avastechnology\LaravelConsole\Traits\ConsoleDisplays;
use Avastechnology\LaravelConsole\Traits\FormattedOutput;
use Illuminate\Foundation\Console\EnvironmentCommand as IlluminateEnvironmentCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class EnvironmentCommand
 *
 * @package App\Extensions\Illuminate
 */
class EnvironmentCommand extends IlluminateEnvironmentCommand
{
    use ConsoleDisplays;
    use FormattedOutput;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->line('<info>Current application environment is:</info> <comment>'.$this->laravel['env'].'</comment>');
        $this->newLine();

        $this->displayAllEnvironments();

        $this->displayConfiguration();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return array_merge(
            parent::getOptions(),
            [
                [
                    'name'        => 'all',
                    'shortcut'    => 'a',
                    'mode'        => InputOption::VALUE_NONE,
                    'description' => 'List all available environments',
                ],
                [
                    'name'        => 'config',
                    'shortcut'    => 'c',
                    'mode'        => InputOption::VALUE_REQUIRED,
                    'description' => 'Configuration name to display the current settings (ie name in config("name");)',
                ],
            ]
        );
    }

    /**
     * @return void
     */
    protected function displayAllEnvironments(): void
    {
        if ($this->option('all')) {
            $this->info('Available Environments:');

            $table = new Table($this->output);
            $table->setHeaders(['Name', 'Environment', '.env file']);

            $environmentPath = $this->getLaravel()->environmentPath() . DIRECTORY_SEPARATOR;

            foreach (Environment::cases() as $name => $label) {
                $envFile = '.env.' . $name;
                $fileExists = file_exists($environmentPath . $envFile);

                if (!$fileExists && $name === Environment::default()) {
                    $envFile = '.env';
                    $fileExists = true;
                }

                $table->addRow(
                    [
                        $name,
                        $label,
                        sprintf(
                            '<%s>%s</%s>',
                            ($fileExists ? 'info' : 'error'),
                            $envFile,
                            ($fileExists ? 'info' : 'error'),
                        )
                    ]
                );
            }

            $table->render();
            $this->newLine();
        }
    }

    /**
     * @return void
     */
    protected function displayConfiguration(): void
    {
        if ($this->option('config')) {
            $this->infof(
                'Configuration: "%s"',
                $this->option('config')
            );

            $this->displayKeyValuePairs(config($this->option('config')), null, '  ', true);
        } else {
            $this->info('Configuration Files:');

            foreach ($this->laravel['config']->all() as $configFile => $values) {
                $this->line('  ' . $configFile);
            }
        }
    }
}
