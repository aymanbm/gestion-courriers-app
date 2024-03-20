<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert([
            'statue' => "مرسلة",
        ]);
        DB::table('status')->insert([
            'statue' => "مستلمة",
        ]);
        DB::table('status')->insert([
            'statue' => "المرسل المعالج",
        ]);
        DB::table('status')->insert([
            'statue' => "المستلم المعالج",
        ]);
    }
}
