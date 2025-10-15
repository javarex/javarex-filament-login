@php
    use Filament\Support\Enums\Width;

    $livewire ??= null;

    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Large);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

    <div class="fi-simple-layout">
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div class="fi-simple-layout-header">
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                    ])
                @endif

                @if (filament()->hasUserMenu())
                    @livewire(Filament\Livewire\SimpleUserMenu::class)
                @endif
            </div>
        @endif

        <div class="fi-simple-main-ctn bg-radial from-[#fdfae8] from-40% to-[#fef9c3]">
            <main
                @class([
                    'fi-simple-main',
                    'px-0',
                    'py-0',
                    'm-0',
                    'rounded-none',
                    'border-none',
                    'bg-transparent',
                    'ring-0',
                    'shadow-none',
                    ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                ])
                id="ddo-login"
            >
                <div class="flex gap-x-2 bg-linear-to-t/srgb from-[#452b02] to-[#edca25] rounded-2xl shadow-2xl">
                    <div class="basis-full sm:basis-1/2 flex-col sm:flex items-center justify-center gap-y-5">
                      
                       <div 
                            style="background-image: url('../images/login-logo.png');"
                            class="bg-no-repeat bg-contain bg-center w-32 h-32"
                        ></div>


                       <div class="uppercase text-sepia_brown font-bold text-2xl text-white">
                        {{ config('app.name') ?? 'System Name'}}
                       </div>
                    </div>
                    <div class="basis-full sm:basis-1/2 py-10 px-10 bg-[#fdfcea] rounded-r-2xl">
                        <div class="text-2xl text-gray-500">Login</div>
                        {{$slot}}
                    </div>
                </div>
            </main>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
    </div>
</x-filament-panels::layout.base>
