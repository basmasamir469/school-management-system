<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('specializations')->delete();
        $specializations=[["en"=>"Arabic","ar"=>"عربي"],
         ["en"=>"Math","ar"=>"رياضيات"]
        ,["en"=>"Science","ar"=>"علوم"]
        ,["en"=>"English","ar"=>"انجليزي"]
        ,["en"=>"French","ar"=>"لغة فرنسية"]
        ,["en"=>"Art","ar"=>"رسم"]
        ,["en"=>"History","ar"=>"تاريخ"]
    ];
        foreach($specializations as $sp){
            Specialization::create([
                'name'=>$sp
            ]);
        }
        
    }
}
