<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between gap-x-3" style="height: 48px">
            <h2 class="font-semibold leading-6 text-gray-950 dark:text-white">
                Witaj {{ filament()->auth()->user()->first_name }}!
            </h2>
            <form action="{{ filament()->getLogoutUrl() }}" method="post" class="my-auto">
                @csrf
                <x-filament::button color="gray" icon="heroicon-m-arrow-left-on-rectangle"
                    icon-alias="panels::widgets.account.logout-button" labeled-from="sm" tag="button" type="submit">
                    Wyloguj się
                </x-filament::button>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
