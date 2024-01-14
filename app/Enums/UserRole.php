<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Admin = 'admin';
    case Operator = 'operator';
    case Student = 'student';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Operator => 'Operador',
            self::Student => 'Estudante',
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
            self::Student => [],
        };
    }
}
