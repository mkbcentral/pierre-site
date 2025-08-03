<?php

use App\Models\Training;
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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Title of the chapter');
            $table->text('content')->nullable()->comment('Content of the chapter');
            $table->string('video_url')->nullable()->comment('URL of the video associated with the chapter');
            $table->foreignIdFor(model: Training::class)
                ->constrained()
                ->comment('Foreign key referencing the training this chapter belongs to');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
