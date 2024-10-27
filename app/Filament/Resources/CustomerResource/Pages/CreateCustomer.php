<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Enums\PermissionEnum;
use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
	
	public function mount(): void
	{
		abort_unless(
			auth()->user()?->can(PermissionEnum::AccountOpeningsCRUD),
			403
		);
		
		parent::mount();
	}
}
