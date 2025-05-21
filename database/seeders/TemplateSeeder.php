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
                'name' => 'Nebula',
                'description' => 'A modern cosmic-inspired portfolio with a smooth gradient background, bold typography, and a focus on simplicity and elegance.',
                'preview_image' => 'templates/nebula.gif',
                'default_data' => json_encode([])
            ],
            [
                'name' => 'Mist',
                'description' => 'Vibrant and colorful layout.',
                'preview_image' => 'templates/mist.gif',
                'default_data' => json_encode([]),
            ],
            [
                'name' => 'Lumina',
                'description' => 'Vibrant and colorful layout.',
                'preview_image' => 'templates/lumina.gif',
                'default_data' => json_encode([]),
            ],
            [
                'name' => 'Aether',
                'description' => 'Vibrant and colorful layout.',
                'preview_image' => 'templates/aether.gif',
                'default_data' => json_encode([]),
            ],
            [
                'name' => 'Orion',
                'description' => 'Vibrant and colorful layout.',
                'preview_image' => 'templates/orion.gif',
                'default_data' => json_encode([]),
            ],
        ]);
    }
}
