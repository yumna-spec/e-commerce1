<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run ()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert(
            [   'name' => 'Admin',
                'email' => 'admin@admin.dev',
                'password' => Hash::make('password'),
            ]
        );
    }
}
