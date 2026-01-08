<?php

namespace App;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::MODERATOR => 'Moderator',
            self::USER => 'User',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ADMIN => 'red',
            self::MODERATOR => 'orange',
            self::USER => 'green',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($role) => [
            $role->value => $role->label()
        ])->toArray();
    }
}
