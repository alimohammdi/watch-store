<?php
namespace App\Enums;

enum RolesEnum:string
{
    // case NAMEINAPP = 'name-in-database';
    case WRITER = 'writer';
    case EDITOR = 'editor';
    case USERMANAGER = 'user-manager';
    case ADMIN    = 'admin';
    case  MANAGER = 'manager';
    case  SUPERADMIN = 'super-admin';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::WRITER => 'نویسنده',
            static::EDITOR => 'ادیتور',
            static::USERMANAGER => 'مدیریت کاربران',
            static::ADMIN => 'ادمین',
            static::MANAGER => 'مدیر',
            static::SUPERADMIN => 'ادمین اصلی',
        };
    }

}
