<?php

namespace App\Models;

use App\Enums\AccountOpeningStatusEnum;
use App\Observers\CustomerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([CustomerObserver::class])]
class Customer extends Model
{
	use HasFactory;
	
    protected $table = 'customers';
	protected $guarded = ['id'];
	
	protected function casts(): array
	{
		return [
			'status_account_opening' => AccountOpeningStatusEnum::class
		];
	}
}
