<div class="fi-simple-page">
    <div class="login-card">
        <div class="login-brand-panel">
            <div class="login-brand-content">
                <div class="login-logo-glow"></div>
                <div
                    style="background-image: url('../images/login-logo.png');"
                    class="login-logo"
                ></div>
                <div class="login-app-name">
                    {{ config('app.name') ?? 'System Name'}}
                </div>
                <div class="login-tagline">
                    {{ config('ddo-login.tagline', 'Online Service Request Portal') }}
                </div>
            </div>
            <div class="login-brand-decoration"></div>
        </div>
        <div class="login-form-panel">
            <div class="login-form-header">
                <div class="login-welcome">Create Account</div>
                <div class="login-subtitle">Sign up to get started</div>
            </div>
            {{ $this->content }}
            <div class="login-register-link">
                <span>Already have an account?</span>
                <a href="{{ filament()->getLoginUrl() }}" class="login-register-anchor">Sign in</a>
            </div>
        </div>
    </div>

    @if (! $this instanceof \Filament\Tables\Contracts\HasTable)
        <x-filament-actions::modals />
    @endif
</div>
