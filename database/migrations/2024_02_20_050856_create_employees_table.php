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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_type_id')->constrained('post_types');
            $table->string('name');
            $table->string('profile_picture');
            $table->string('email');
            $table->string('phone_code')->nullable();
            $table->unsignedBigInteger('phone_number');
            $table->text('address');
            $table->enum('status', [0, 1])->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
