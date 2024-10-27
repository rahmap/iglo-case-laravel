<?php

namespace App\Enums;

enum RoleEnum: string
{
    case CustomerService = 'customer_service';
    case Supervisor = 'supervisor';
    case Staff = 'staff';
	
	public static function getAll(bool $withKey = false, string $keyName = 'name'): array
	{
		return array_map(fn($role) => $withKey ? [$keyName => $role->value] : $role->value, self::cases());
	}
}
