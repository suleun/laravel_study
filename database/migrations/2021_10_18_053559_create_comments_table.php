<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // null 값을 허용하고 싶다면 nullable...? -> 이용해서 쓰면 된다
            $table->string("comment");

            // 외래키 참조
            $table->foreignId('user_id') // user 테이블에서 id를 가져오겠다
            ->constrained()
            ->onDelete('cascade'); // 유저 테이블에서 id 삭제 되었을 경우 나도 삭제!

            $table->foreignId('post_id') // post 테이블에서 id를 가져오겠다
            ->constrained()
            ->onDelete('cascade'); // 포스트 테이블에서 id 삭제 되었을 경우 나도 삭제!
            // 외래키 참조 끝

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
        Schema::dropIfExists('comments');
    }
}
