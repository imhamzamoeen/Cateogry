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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('quantity')->default(1);
            $table->enum('type',['in','out'])->default('in');
            $table->foreignId('unit_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('last_performer')->nullable();
            $table->foreignId('user_id')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status',['pending','rejected','approved','disapproved'])->default('pending');
            $table->softDeletes();
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
};
