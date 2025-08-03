<?php

use App\Enums\LevelType;
use App\Enums\TrainingStatusType;
use App\Models\CategoryTraining;
use App\Models\Chapter;
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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Title of the training');
            $table->text('description')->nullable()->comment('Description of the training');
            $table->string('cover_image')->nullable()->comment('Image associated with the training');
            $table->double('price')->default(0.0)->comment('Price of the training');
            $table->enum('level', LevelType::getValues())->default(LevelType::BEGINNER)->comment('Level of the training');
            $table->enum('status', TrainingStatusType::getValues())->default(TrainingStatusType::DRAFT)->comment('Status of the training');
            $table->string('a')->comment('Title of the training');
            $table->foreignIdFor(CategoryTraining::class)
                ->constrained('category_trainings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->comment('Foreign key referencing the category this training belongs to');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
