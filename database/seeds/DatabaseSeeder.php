<?php

namespace Database\Seeders;

use App\User;
use Database\Seeders\BloodTypeSeeder;
use Database\Seeders\NationalitySeeder;
use Database\Seeders\ReligionSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\SpecializationSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        User::create([
         'name'=>'basma',
         'email'=>'basmaelazony@gmail.com',
         'password'=>Hash::make('123456')
        ]);
           $this->call(BloodTypeSeeder::class);
           $this->call(NationalitySeeder::class);
           $this->call(ReligionSeeder::class);
           $this->call(GenderSeeder::class);
           $this->call(SpecializationSeeder::class);

    }
}
