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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name', 100)->nullable(false);
            $table->string('type', 100)->nullable(false);
            $table->integer('quantity')->unsigned()->nullable(); // 整数のみ許容
            $table->string('detail', 100)->nullable();
            $table->timestamps();

            // id,user_id,name,typeカラムにインデックスを設定
            $table->index(['id','user_id','name','type']);
            // 'user_id'は'users'テーブルの'id'カラムを参照する
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
