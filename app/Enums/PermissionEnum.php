<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case AccountOpeningsAccess = 'account_openings_access';
    case AccountOpeningsCRUD = 'account_openings_crud';
    case AccountOpeningsApprover = 'account_openings_approver';
	
	public static function getAll(bool $withKey = false, string $keyName = 'name'): array
	{
		return array_map(fn($permission) => $withKey ? [$keyName => $permission->value] : $permission->value, self::cases());
	}
}
