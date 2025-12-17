<?php

namespace Javarex\DdoLogin;

use Filament\Panel;
use Filament\Actions\Action;
use Filament\Contracts\Plugin;
use Javarex\DdoLogin\Pages\Edit;
use Javarex\DdoLogin\Pages\Login;

class LoginDdoPlugin implements Plugin
{

    protected bool $useUsername = false;
    protected string | null $tagline = null;
    
    public function getId(): string
    {
        return 'javrex-ddologin';
    }

    public static function make(): LoginDdoPlugin
    {
        return new LoginDdoPlugin();
    }

    public function useUsername(bool $value = true): static
    {
        $this->useUsername = $value;

        return $this;
    }

    public function tagline(string | null $value = null): static
    {
        $this->tagline = $value;

        return $this;
    }

    public function register(Panel $panel): void
    {

        Login::$useUsername = config('ddo-login.use_username_login');
        Login::$login_type = config('ddo-login.use_username_login') ? 'username' : 'email';
        Login::$tagline = $this->tagline ?? config('ddo-login.tagline');

        $panel
            // ->pages([
            //     Login::class,
            // ])
            ->login(Login::class)
            ->profile(Edit::class)
            ->userMenuItems([
                'profile' => fn(Action $action) => $action->label(fn() => auth()->user()->name)->url(''),
                'edit-profile' => fn(Action $action) => $action->make('edit-profile')->url(fn (): string => Edit::getUrl())->label('Edit Account')->icon('heroicon-o-pencil-square'),
                'logout' => fn(Action $action) => $action->label('Log out')
            ]);
    }

    public function boot(Panel $panel): void
    {
    }
}