<?php

// 親テーブル
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
        Schema::create('brochures', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);
            $table->unsignedBigInteger('user_id')->unsigned()->nullable(false);
            $table->string('name', 100)->nullable(false);
            $table->unsignedBigInteger('area_id')->nullable(false);
            $table->integer('quantity')->unsigned()->nullable(false); // 整数のみ許容
            $table->string('detail', 100)->nullable();
            $table->string('img_path')->nullable();
            $table->string('img_public_id')->nullable();
            $table->timestamps();

            // id,user_id,name,areaカラムにインデックスを設定
            $table->index(['id','user_id','name','area_id']);
            // areaカラムの外部キー制約追加
            $table->foreign('area_id')->references('id')->on('areas');
            // 'user_id'は'users'テーブルの'id'カラムを参照する
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('brochures');
    }
};
