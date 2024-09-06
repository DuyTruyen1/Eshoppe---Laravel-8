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
        Schema::create('product', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('id_user')->constrained('users');
            $table->string('name'); 
            $table->decimal('price', 10, 2);
            $table->foreignId('id_category')->constrained('category');
            $table->foreignId('id_brand')->constrained('brand'); 
            $table->boolean('status')->default(0); 
            $table->boolean('sale')->default(0);
            $table->string('company');
            $table->string('hinhanh'); 
            $table->text('detail'); $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
