<?php

namespace Javarex\DdoLogin\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'ddo-login:install';
    protected $description = 'Install the DDO Login plugin with optional publish steps';

    public function handle(): int
    {
        $this->info('🚀 Installing DDO Login Plugin...');

        $this->call('vendor:publish', [
            '--tag' => 'migration',
            '--force' => true,
        ]);

        if (! File::isDirectory(public_path('images'))) {
            File::makeDirectory(public_path('images'));
            File::copy(
                __DIR__ . '/../../resources/images/login-logo.png',
                public_path('images/login-logo.png')
            );
        }

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


        $providerPath = app_path('Providers/Filament/AdminPanelProvider.php');

        if (File::exists($providerPath)) {
            $contents = File::get($providerPath);

            if (! str_contains($contents, "LoginDdoPlugin::make()")) {
                $updated = str_replace(
                    "->plugins([",
                    "->plugins([\n                \\Javarex\\DdoLogin\\LoginDdoPlugin::make(),",
                    $contents
                );

                File::put($providerPath, $updated);
                $this->info('✅ LoginDdoPlugin added to AdminPanelProvider.');
            } else {
                $this->warn('⚠️ LoginDdoPlugin already exists in AdminPanelProvider.');
            }
        } else {
            $this->error('❌ AdminPanelProvider not found.');
        }

        $this->info('✅ DDO Login installation complete!');

        return self::SUCCESS;
    }
}
