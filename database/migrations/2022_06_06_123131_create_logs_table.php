<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor')->constrained('users');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('file_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
