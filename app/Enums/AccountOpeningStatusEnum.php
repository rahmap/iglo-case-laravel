<?php

namespace App\Enums;

enum AccountOpeningStatusEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
	
	public static function getAll(bool $withKey = false, string $keyName = 'name'): array
	{
		return array_map(fn($permission) => $withKey ? [$keyName => $permission->value] : $permission->value, self::cases());
	}
}
