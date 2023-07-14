<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('gender')->default(User::GENDER_MALE);
            $table->boolean('nationality')->default(true);
            $table->integer('race')->default(User::RACE_CHINESE);
            $table->string('ic_number')->nullable();
            $table->date('birthdate');
            $table->string('passport_number')->nullable();
            $table->integer('maritial_status')->default(User::MARITIAL_STATUS_SINGLE);
            $table->string('contact');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('emergency_contact');
            $table->string('emergency_contact_relationship');
            $table->longText('background');
            $table->string('profile_picture')->nullable();

            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('epf_account_number');
            $table->string('socso_account_number');
            $table->string('income_tax_number');

            $table->string('employee_id');
            $table->string('password');
            $table->integer('employment_type')->default(User::EMPLOYMENT_TYPE_PERMENANT);
            $table->string('designation');
            $table->double('salary', 0, 2)->default(0.00);
            $table->date('joining_date')->default(Carbon::now()->format('Y-m-d'));
            $table->string('offer_letter_attachment')->nullable();
            $table->string('permanent_attachment')->nullable();

            $table->boolean('admin_status')->default(false);
            $table->integer('admin_type')->nullable();

            $table->integer('sick_leaves')->default(7);
            $table->integer('annual_leaves')->default(7);
            $table->integer('year_end_bonus_level')->default(1);
            $table->integer('attitude')->default(100);
            $table->integer('punctuality')->default(100);

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
