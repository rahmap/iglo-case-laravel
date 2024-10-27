<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AccountOpeningStatusEnum: string implements HasLabel, HasColor
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
	
	public function getLabel(): ?string
	{
		return match ($this) {
			self::Pending => 'Pending',
			self::Approved => 'Approved',
			self::Rejected => 'Rejected',
		};
	}
	
	public function getColor(): string|array|null
	{
		return match ($this) {
			self::Pending => 'warning',
			self::Approved => 'success',
			self::Rejected => 'danger',
		};
	}
	
	public static function getAllWithKeyValue(): array
	{
		return array_reduce(self::cases(), function ($result, $status) {
			$result[$status->value] = $status->getLabel();
			return $result;
		}, []);
	}
	
	public static function getAll(bool $withKey = false, string $keyName = 'name'): array
	{
		return array_map(fn($status) => $withKey ? [$keyName => $status->value] : $status->value, self::cases());
	}
}
