<?php

use App\Models\Leaves;
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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('leave_type')->default(Leaves::TYPE_ANNUAL);
            $table->dateTime('from_date');
            $table->dateTime('end_date')->nullable();
            $table->integer('days');
            $table->integer('status')->default(Leaves::STATUS_PENDING);
            $table->string('attachment')->nullable();
            $table->string('reason')->nullable();
            $table->string('leave_reason')->nullable();
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
        Schema::dropIfExists('leaves');
    }
};
