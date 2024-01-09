<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->foreign('category_id')
                ->unsigned()
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->integer('currency_id');
            $table->foreign('currency_id')
                ->unsigned()
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade');
            $table->string('title'); 
            $table->longText('description'); 
            $table->string('donation_img')->nullable(); 
            $table->string('additional_ressources')->nullable(); // Extra ressources like more pictures, videos etc
            $table->enum('type',['self','others']);
            $table->string('target_amount'); 
            $table->string('contributed_amount');
            $table->boolean('is_complete')->default(false); // Checks if target set is reached.
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
