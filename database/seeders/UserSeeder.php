<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = '$2y$10$G5QPCuBsGaz2mDApzDdLDek3mTSm181Uink9vaHxVGOEeYEDwLhna';
        DB::statement("

        INSERT INTO users
        (id, name, gender, nationality, race,
         ic_number, birthdate, passport_number, maritial_status, contact, email,
         address, emergency_contact, emergency_contact_relationship, background, bank_name, bank_account_number, epf_account_number, socso_account_number, income_tax_number, employee_id, password, employment_type, designation, salary, joining_date, offer_letter_attachment, permanent_attachment, admin_status, admin_type, sick_leaves, annual_leaves, year_end_bonus_level, attitude, punctuality, email_verified_at, remember_token, created_at, updated_at, deleted_at, department_id)
        VALUES
            (1, 'admin', 1, true, 1, '010114140693', '2001/01/01', null, 1, '0162218806', 'kzy014@hotmail.com', 'sungai long', '0162208806', 'self', 'studying in APU', 'HLB', '32250039867', 'testepf', 'testsocso', 'testincome', 'CT0001','$password', 1, 'software developer', 800.00, NOW(), null, null, false, null, 7, 7, 1, 100, 100, null, null, NOW(), NOW(), null, 1)

            ");
    }
}
