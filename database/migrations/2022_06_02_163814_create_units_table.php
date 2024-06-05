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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('description', 120);
            $table->double('price')->default(0);
            $table->double('quantity')->default(1);
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('SubCategory_id')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('SubCategory_id')->references('id')->on('sub_categories')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('image')->nullable()->default('Unit_Default.png');
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
        Schema::dropIfExists('units');
    }
};
