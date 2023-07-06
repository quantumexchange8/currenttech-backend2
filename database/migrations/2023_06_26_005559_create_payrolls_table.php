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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->double('working_days', 0, 2)->default(0.00);

            $table->double('dw', 0, 2)->default(0.00);
            $table->double('eo', 0, 2)->default(0.00);
            $table->double('lat', 0, 2)->default(0.00);
            $table->double('tof', 0, 2)->default(0.00);

            $table->double('basic_pay', 0, 2)->default(0.00);
            $table->double('daily_attendance', 0, 2)->default(0.00);
            $table->double('meal', 0, 2)->default(0.00);
            $table->double('night_shift_allowance', 0, 2)->default(0.00);
            $table->double('normal_ot', 0, 2)->default(0.00);
            $table->double('rest_ot', 0, 2)->default(0.00);

            $table->double('employee_epf', 0, 2)->default(0.00);
            $table->double('employee_socso', 0, 2)->default(0.00);
            $table->double('employee_eis', 0, 2)->default(0.00);
            $table->double('employee_pcb', 0, 2)->default(0.00);
            $table->double('early_out', 0, 2)->default(0.00);
            $table->double('lateness', 0, 2)->default(0.00);
            $table->double('time_off', 0, 2)->default(0.00);

            $table->double('employer_epf', 0, 2)->default(0.00);
            $table->double('employer_socso', 0, 2)->default(0.00);
            $table->double('employer_eis', 0, 2)->default(0.00);

            $table->double('annual_leave', 0, 2)->default(0.00);
            $table->double('mc_leave', 0, 2)->default(0.00);

            $table->string('remark')->nullable();
            $table->string('month');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
