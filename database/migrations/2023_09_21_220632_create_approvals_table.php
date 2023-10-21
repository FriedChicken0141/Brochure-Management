<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);
            $table->unsignedBigInteger('user_id')->unsigned()->nullable(false);
            $table->unsignedBigInteger('brochure_id')->unsigned()->nullable(false);
            $table->integer('quantity')->unsigned()->nullable(false); // 整数のみ許容
            $table->string('detail', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->timestamps();

            // 'user_id'は'users'テーブルの'id'カラムを参照する
            $table->foreign('user_id')->references('id')->on('users');
            // 'brochure_id'は'brochures'テーブルの'id'カラムを参照する
            $table->foreign('brochure_id')->references('id')->on('brochures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_approvals');
    }
};
