<?php

use App\Enums\OrderStatus;
use App\Models\Training;
use App\Models\User;
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
        Schema::create('order_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(Training::class)
                ->constrained()
                ->onDelete('cascade');
            $table->enum('status', OrderStatus::getValues())
                ->default(OrderStatus::PENDING);
            $table->float('amount')->default(0);
            $table->string('payment_reference')->unique();
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_trainings');
    }
};
