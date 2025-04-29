<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profession::insert([
            ['name' => 'Software Engineer', 'is_other' => false],
            ['name' => 'Web Developer', 'is_other' => false],
            ['name' => 'Mobile Developer', 'is_other' => false],
            ['name' => 'UI/UX Designer', 'is_other' => false],
            ['name' => 'Project Manager', 'is_other' => false],
            ['name' => 'Architect', 'is_other' => false],
            ['name' => 'Business Analyst', 'is_other' => false],
            ['name' => 'Data Scientist', 'is_other' => false],
            ['name' => 'Marketing Specialist', 'is_other' => false],
            ['name' => 'Other', 'is_other' => true],
        ]);
    }
}
