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
       Schema::create('form_fields', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('label');

            $table->enum('type', [
                'text',
                'number',
                'textarea',
                'radio',
                'checkbox',
                'select'
            ]);

            $table->boolean('is_required')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->foreignId('parent_field_id')
                ->nullable()
                ->constrained('form_fields')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
