<?php

namespace App\Filament\Actions\Customer;

use App\Enums\AccountOpeningStatusEnum;
use Filament\Tables\Actions\Action;

class RejectAction extends Action
{
	public static function make(?string $name = NULL): static
	{
		return parent::make('reject')
			->label('Reject')
			->icon('heroicon-o-exclamation-circle')
			->color('danger')
			->requiresConfirmation()
			->modalHeading('Reject Approval')
			->modalDescription('Are you sure you want to reject this account opening?')
			->action(function ($record) {
				$record->update(['status_account_opening' => AccountOpeningStatusEnum::Rejected]);
			})
			->visible(fn ($record) => $record->status_account_opening === AccountOpeningStatusEnum::Pending);
	}
}
