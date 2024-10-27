<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('customer:seed {count=10}', function () {
	\App\Models\Customer::factory()->count((int) $this->argument('count'))->create();
})->purpose('Seed Customer Approval');
