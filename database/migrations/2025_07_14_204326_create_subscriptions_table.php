<?php

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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name of the subscription');
            $table->text('description')->nullable()->comment('Description of the subscription');
            $table->decimal('amount', 8, 2)->default(0.00)->comment('Amount of the subscription');
            $table->decimal('transaction_amount', 8, 2)->default(0.00)->comment('Transaction amount');
            $table->string('currency', 3)->default('USD')->comment('Currency of the subscription amount');
            $table->enum('source', ['bank', 'mobile_money'])->default('bank')->comment('Source of the subscription payment');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Status of the subscription');
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->comment('Foreign key referencing the user who owns the subscription');
            $table->foreignId('training_id')
                ->constrained('trainings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->comment('Foreign key referencing the training associated with the subscription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
