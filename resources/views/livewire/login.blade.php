<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit="handleLogin">
            <x-input wire:model.blur="email" required label="E-mail"></x-input>
            <x-input wire:model.blur="password" required label="Senha"></x-input>

            <div class="text-sm">
                <x-link>Forgot password?</x-link>
            </div>

            <x-button wire:loading.attr="disabled" wire:target="login">
                Acessar
            </x-button>
        </form>

        <p class="mt-10 text-center text-sm">
        Not a member? <x-link>Start a 14 day free trial</x-link>
        </p>
    </div>
</div>
