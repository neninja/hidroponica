<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class DemoImpersonate extends Component
{
    public const WEBAPP_PLATFORM = 'webapp';

    public const BACKOFFICE_PLATFORM = 'backoffice';

    public array $platforms;

    public function mount()
    {
        $this->platforms = [
            self::BACKOFFICE_PLATFORM => [
                'name' => 'Backoffice',
                'description' => 'Plataforma administrativa do projeto',
                'stack' => [
                    'Laravel',
                    'Filament',
                    'AlpineJS',
                    'Tailwind',
                    'Vite',
                ],
            ],
            self::WEBAPP_PLATFORM => [
                'name' => 'Web App',
                'description' => 'Plataforma do usuário final para estudar inglês',
                'stack' => [
                    'Laravel',
                    'Livewire',
                    'AlpineJS',
                    'Tailwind',
                    'Vite',
                ],
            ],
        ];
    }

    public function render()
    {
        return view('livewire.demo-impersonate');
    }

    #[On(self::BACKOFFICE_PLATFORM)]
    public function impersonateBackoffice()
    {
        $userId = User::where('role', UserRole::DemoOperator)->pluck('id')->first();
        auth()->loginUsingId($userId);
        redirect()->route('filament.admin.pages.dashboard');
    }

    #[On(self::WEBAPP_PLATFORM)]
    public function impersonateWebApp()
    {
        $userId = User::where('role', UserRole::DemoStudent)->pluck('id')->first();
        auth()->loginUsingId($userId);
        redirect()->route('home');
    }
}
