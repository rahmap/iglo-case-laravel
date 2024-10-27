<?php

namespace App\Observers;

use App\Enums\AccountOpeningStatusEnum;
use Illuminate\Database\Eloquent\Model;

class CustomerObserver
{
	public function creating(Model $model): void
	{
		if ($model->isClean('status_account_opening')) {
			$model->fill([
				'status_account_opening' => AccountOpeningStatusEnum::Pending
			]);
		}
	}
}
