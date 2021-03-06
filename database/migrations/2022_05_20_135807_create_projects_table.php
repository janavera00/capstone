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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('stepNo');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('location');
            $table->string('lot_number')->nullable();
            $table->string('survey_number')->nullable();
            $table->string('lot_area')->nullable();
            $table->string('land_owner')->nullable();
            $table->enum('status', ['Active', 'Completed', 'Archived']);
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
        Schema::dropIfExists('projects');
    }
};
