<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Enums\AccountOpeningStatusEnum;
use App\Enums\PermissionEnum;
use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
	
	public function mount(int|string|Model $record): void
	{
		parent::mount($record);
		
		abort_if(
			!auth()->user()?->can(PermissionEnum::AccountOpeningsCRUD) || $this->getRecord()->status_account_opening !== AccountOpeningStatusEnum::Pending,
			403
		);
	}
}
