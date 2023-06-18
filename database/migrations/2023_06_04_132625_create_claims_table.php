<?php

use App\Models\Claims;
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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->integer('claim_type')->default(Claims::TYPE_OTHERS);
            $table->double('amount', 0, 2)->default(0.00);
            $table->string('description');
            $table->string('merchant');
            $table->string('reason');
            $table->string('decline_reason')->nullable();
            $table->integer('status')->default(Claims::STATUS_PENDING);
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('claims');
    }
};
