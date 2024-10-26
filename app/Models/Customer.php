<?php

namespace App\Models;

use App\Enums\AccountOpeningStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
	protected $guarded = ['id'];
	
	protected function casts(): array
	{
		return [
			'status_account_opening' => AccountOpeningStatusEnum::class
		];
	}
}
