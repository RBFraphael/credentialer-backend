<?php
namespace App\Enums;

class UserRole {
    const ADMIN = "Admin";
    const MANAGER = "Manager";
    const DEVELOPER = "Developer";

    public static function cases()
    {
        return [
            static::ADMIN,
            static::MANAGER,
            static::DEVELOPER,
        ];
    }

    public static function dictionary()
    {
        return [
            static::ADMIN => __(static::ADMIN),
            static::MANAGER => __(static::MANAGER),
            static::DEVELOPER => __(static::DEVELOPER)
        ];
    }

    public static function label($case)
    {
        return static::dictionary()[$case] ?? "";
    }
}
