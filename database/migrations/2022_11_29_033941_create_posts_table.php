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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggalDibuat');
            $table->text('isi');
            $table->boolean('tampilPost')->default(1);
            $table->foreignId('category_id')->constrained()->onCascadeUpdate()->onCascadeDelete();
            $table->foreignId('user_id')->constrained()->onCascadeUpdate()->onCascadeDelete();
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
        Schema::dropIfExists('posts');
    }
};
