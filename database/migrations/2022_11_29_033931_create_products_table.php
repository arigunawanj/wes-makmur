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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('namaProduk');
            $table->string('foto');
            $table->integer('harga');
            $table->text('descProduk');
            $table->boolean('tampilBarang')->default(1);
            $table->foreignId('category_id')->constrained()->onCascadeUpdate()->onCascadeDelete();
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
        Schema::dropIfExists('products');
    }
};
