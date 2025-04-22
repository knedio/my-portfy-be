<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Template::insert([
            [
                'name' => 'Classic',
                'description' => 'Clean, traditional layout.',
                'preview_image' => 'templates/classic.png',
                'default_data' => json_encode([])
            ],
            [
                'name' => 'Modern',
                'description' => 'Sleek and minimalist.',
                'preview_image' => 'templates/modern.png',
                'default_data' => json_encode([]),
            ],
        ]);
    }
}
