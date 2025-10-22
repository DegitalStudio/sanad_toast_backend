<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case PRINTER_MANAGER = 'printer_manager';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Admin',
            self::PRINTER_MANAGER => 'Printer Manager',
        };
    }
}
