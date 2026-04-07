<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id(); // INT PRIMARY KEY AUTO_INCREMENT
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->decimal('bathrooms', 2, 1)->nullable();
            $table->integer('sqft')->nullable();
            $table->text('image')->nullable();
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
