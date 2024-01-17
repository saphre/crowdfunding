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
        Schema::create('users_donations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->foreign('user_id')
                ->unsigned()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('donation_id')->unsigned();
            $table->foreign('donation_id')
                ->unsigned()
                ->references('id')
                ->on('donations')
                ->onDelete('cascade');
            $table->boolean('is_initiator')->default(false); // Checks if the user is the initiator of the donation .
            $table->string('amount_contributed')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_donations');
    }
};
