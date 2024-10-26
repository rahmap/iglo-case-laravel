<?php

use App\Enums\AccountOpeningStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
	        $table->id();
	        $table->string('name');
			$table->string('account_number')->unique();
			$table->enum('status_account_opening', AccountOpeningStatusEnum::getAll())->default(AccountOpeningStatusEnum::Pending->value);
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
