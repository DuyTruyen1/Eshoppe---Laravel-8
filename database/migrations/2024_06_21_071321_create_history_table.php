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
        Schema::table('history', function (Blueprint $table) {
            Schema::create('history', function (Blueprint $table) {
                $table->id();
                $table->string('email');
                $table->string('phone');
                $table->string('name');
                $table->foreignId('id_user')->constrained('users');
                $table->decimal('price', 10, 2);
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
};
