<?php

namespace App\Filament\Actions\Customer;

use App\Enums\AccountOpeningStatusEnum;
use Filament\Tables\Actions\Action;

class ApproveAction extends Action
{
	public static function make(?string $name = NULL): static
	{
		return parent::make('approve')
			->label('Approve')
			->icon('heroicon-o-check-circle')
			->color('success')
			->requiresConfirmation()
			->modalHeading('Confirm Approval')
			->modalDescription('Are you sure you want to approve this account opening?')
			->action(function ($record) {
				$record->update(['status_account_opening' => AccountOpeningStatusEnum::Approved]);
			})
			->visible(fn ($record) => $record->status_account_opening === AccountOpeningStatusEnum::Pending);
	}
}
