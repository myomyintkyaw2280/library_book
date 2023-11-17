<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class CreateUserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypes = ['Admin', 'Manager', 'Staff', 'Cashier'];
        foreach ($userTypes as $row) {
             UserType::create(['name' => $row]);
        }
    }
}
