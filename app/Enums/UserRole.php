<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Admin = 'admin';
    case Operator = 'operator';
    case Consumer = 'consumer';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Operator => 'Operador',
            self::Consumer => 'Consumidor',
        };
    }

    public function permissions(): array
    {
        return match ($this) {
            self::Admin => [
                UserPermission::AccessBackoffice,
            ],
            self::Operator => [
                UserPermission::AccessBackoffice,
            ],
            self::Consumer => [],
        };
    }
}
