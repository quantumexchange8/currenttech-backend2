<?php

use App\Models\Projects;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category')->default(Projects::CATEGORY_NEW);
            $table->longText('description');
            $table->string('attachment');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('notification_target')->default(Projects::TARGET_MEMBER);
            $table->integer('priority')->default(Projects::PRIORITY_URGENT);
            $table->string('members');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
