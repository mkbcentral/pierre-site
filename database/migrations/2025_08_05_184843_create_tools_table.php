<?php

use App\Enums\StatusType;
use App\Models\CategoryTool;
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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Nom de l'outil");
            $table->double('price')->default(0)->comment("Le prix de l'outil");
            $table->string('tool_link')->nullable()->comment("Le lien de l'outil");
            $table->string('icon')->nullable()->comment("L'icone de l'outil");
            $table->enum('status', StatusType::getValues())->default(StatusType::DRAFT)->comment('Status of the training');
            $table->foreignIdFor(CategoryTool::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
