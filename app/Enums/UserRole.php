<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Admin = 'admin';
    case Operator = 'operator';
    case Student = 'student';
    case DemoOperator = 'demo-operator';
    case DemoStudent = 'demo-student';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Operator => 'Operador',
            self::Student => 'Estudante',
            self::DemoOperator => 'Operador em demonstração',
            self::DemoStudent => 'Estudante em demonstração',
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
            self::DemoOperator => [
                UserPermission::AccessBackoffice,
            ],
            self::DemoStudent => [],
            self::Student => [],
        };
    }
}
