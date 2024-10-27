<?php

namespace Database\Factories;

use App\Enums\AccountOpeningStatusEnum;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
	use WithoutModelEvents;
	
	protected $model = Customer::class;
	
	public function definition(): array
	{
		$now = now();
		
		return [
			'name' => $this->faker->name(),
			'account_number' => $this->faker->unique()->numerify('################'),
			'status_account_opening' => $this->faker->randomElement(AccountOpeningStatusEnum::cases())->value,
			'created_at' => $now,
			'updated_at' => $now
		];
	}
}
