<?php

namespace Javarex\DdoLogin\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'ddo-login:install';
    protected $description = 'Install the DDO Login plugin with optional publish steps';

    public function handle(): int
    {
        $this->info('🚀 Installing DDO Login Plugin...');

        if ($this->confirm('Do you want to publish the config file?', true)) {
            $this->call('vendor:publish', [
                '--tag' => 'ddo-login-config',
                '--force' => true,
            ]);
        }

        if ($this->confirm('Do you want to publish the Edit Profile page?', false)) {
            $this->call('vendor:publish', [
                '--tag' => 'ddo-login-edit',
                '--force' => true,
            ]);
        }

        if ($this->confirm('Do you want to publish the Login page?', false)) {
            $this->call('vendor:publish', [
                '--tag' => 'ddo-login',
                '--force' => true,
            ]);
        }

        if ($this->confirm('Do you want to publish the login view?', false)) {
            $this->call('vendor:publish', [
                '--tag' => 'ddo-login-views',
                '--force' => true,
            ]);
        }

        $this->info('✅ DDO Login installation complete!');

        return self::SUCCESS;
    }
}
