<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('market_id');
            $table->string('nama_penerima');
            $table->string('nomor_hp');
            $table->text('alamat');
            $table->integer('qty');
            $table->integer('total');
            $table->string('kode');
            $table->string('status')->default('PENDING');
            $table->string('no_resi')->nullable();
            $table->string('kurir_name');
            $table->string('url_photo')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
