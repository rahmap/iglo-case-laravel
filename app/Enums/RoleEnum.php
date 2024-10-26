<?php

namespace App\Enums;

enum RoleEnum: string
{
    case CustomerService = 'customer_service';
    case Supervisor = 'supervisor';
	
	public static function getAll(bool $withKey = false, string $keyName = 'name'): array
	{
		return array_map(fn($permission) => $withKey ? [$keyName => $permission->value] : $permission->value, self::cases());
	}
}
