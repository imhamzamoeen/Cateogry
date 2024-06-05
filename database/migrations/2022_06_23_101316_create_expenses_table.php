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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->double('total_amount')->default(0);
            $table->double('share_amount')->nullable()->default(0);
            $table->string('share_by',50)->nullable();
            $table->double('net_expense')->default(0);
            $table->double('last_balance')->default(0);
            $table->string('description',200)->nullable();
            $table->double('balance')->default(0);
            $table->enum('status',['hold','signed','approved','disapproved'])->default('signed');
            $table->unsignedBigInteger('SubCategory_id');
            $table->foreign('SubCategory_id')->references('id')->on('sub_categories')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('Category_id');
            $table->foreign('Category_id')->references('id')->on('categories')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
                $table->unsignedBigInteger('added_by');
                $table->foreign('added_by')->references('id')->on('users')->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('expenses');
    }
};
