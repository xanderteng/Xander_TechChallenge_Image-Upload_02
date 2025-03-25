<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Create the 'images' table
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('image_path'); // Column to store the uploaded image file path
            $table->timestamps(); // Automatically managed created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop the 'images' table if rolling back the migration.
        Schema::dropIfExists('images');
    }
}
