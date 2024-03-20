<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'nom' => "Administrateur",
            'username' => "admin",
            'password' => Hash::make("admin@admin"),
            'statue' => "admin",
        ]
    );
        DB::table('profiles')->insert([
            'nom' => "Register Assistant",
            'username' => "register",
            'password' => Hash::make("register2134"),
            'statue' => "register",
        ]
    );
    }

}
