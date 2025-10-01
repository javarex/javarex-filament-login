<?php

namespace Javarex\DdoLogin\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'ddo-login:publish';
    protected $description = 'Publish ddo-login file/s';

    public function handle(): int
    {
        $this->info('DDO Login publish file/s');

        $choice = $this->choice(
            'What file do you want to publish?',
            [
                'All',
                'Config',
                'Views',
                'Login Page',
                'Edit Account Page',
            ],
        );

        match ($choice) {
            '0' => function() {
                $this->call('vendor:publish', [
                    '--tag' => 'ddo-login-config',
                    '--force' => true,
                ]);
                $this->call('vendor:publish', [
                    '--tag' => 'ddo-login-views',
                    '--force' => true,
                ]);
                $this->call('vendor:publish', [
                    '--tag' => 'ddo-login',
                    '--force' => true,
                ]);
                $this->call('vendor:publish', [
                    '--tag' => 'ddo-login-edit',
                    '--force' => true,
                ]);
            },

            '1' => $this->call('vendor:publish', [
                    '--tag' => 'ddo-login-config',
                    '--force' => true,
                ]),
            '2' =>  $this->call('vendor:publish', [
                    '--tag' => 'ddo-login-views',
                    '--force' => true,
            ]),
            '3' => $this->call('vendor:publish', [
                '--tag' => 'ddo-login',
                '--force' => true,
            ]),
            '4' => $this->call('vendor:publish', [
                '--tag' => 'ddo-login-edit',
                '--force' => true,
            ]),
        };
        
        return self::SUCCESS;
    }
}