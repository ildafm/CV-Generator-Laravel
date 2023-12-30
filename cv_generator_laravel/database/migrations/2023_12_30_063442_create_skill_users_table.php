<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSkillUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_user_id'); // Kolom untuk relasi ke tabel users
            $table->foreign('detail_user_id')->references('id')->on('detail_users')->onDelete('cascade');

            $table->string('skill_name', 20);
            $table->string('skill_confident', 3);

            // Tambahkan default dan onUpdate untuk timestamps
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes(); // Tambahkan ini untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_users');
    }
}
