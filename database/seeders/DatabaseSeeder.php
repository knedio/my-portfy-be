<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'knedio.info@gmail.com',
            'password' => Hash::make('qwerty.123'),
            'contact_email' => 'knedio.info@gmail.com',
            'location' => 'w',
            'about' => [
                'title' => 'About Me',
                'description' => "<p>I'm a passionate developer with a keen eye for design and a love for creating elegant solutions to complex problems. With expertise in modern web technologies, I bring ideas to life through clean code and intuitive interfaces.</p>\n<br />\n<p>When I'm not coding, you can find me exploring new technologies, contributing to open-source projects, or sharing my knowledge through technical writing and mentoring.</p>",
                'image' => 'https://picsum.photos/seed/profile/400',
            ],
            'banner' => [
                'title' => "Hi, I'm John Doe",
                'description' => 'Full Stack Developer & UI/UX Enthusiast',
                'btn_label' => 'Get in Touch',
            ],
        ]);
    
        $user->educations()->create([
            'school' => 'AMS',
            'degree' => 'BSIT',
            'year_from' => '2018',
            'year_to' => '2022',
        ]);
    
        $user->projects()->createMany([
            [
                'title' => 'E-Commerce Platform',
                'description' => 'A modern e-commerce platform with real-time inventory and AI-powered recommendations.',
                'tech' => 'VueJS, Typescript, Tailwind',
                'image' => 'https://picsum.photos/seed/1/800/600',
                'link' => null,
            ],
            [
                'title' => 'Social Media Dashboard',
                'description' => 'Analytics dashboard with real-time data visualization and reporting.',
                'tech' => 'Node.js, Socket.io, MongoDB',
                'image' => 'https://picsum.photos/seed/2/800/600',
                'link' => null,
            ],
            [
                'title' => 'Task Management App',
                'description' => 'Collaborative task management with real-time updates and team features.',
                'tech' => 'React, Redux, Firebase',
                'image' => 'https://picsum.photos/seed/3/800/600',
                'link' => null,
            ],
        ]);
    
        $user->skills()->createMany([
            [
                'name' => 'Frontend',
                'level' => '9',
                'experience' => '5+ years',
                'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
            ],
            [
                'name' => 'Backend',
                'level' => '8',
                'experience' => '4+ years',
                'icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4',
            ],
            [
                'name' => 'DevOps',
                'level' => '7',
                'experience' => '3+ years',
                'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            ],
            [
                'name' => 'UI/UX',
                'level' => '8',
                'experience' => '4+ years',
                'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
            ],
        ]);
    
        $this->call([
            TemplateSeeder::class,
        ]);
    }
    
}
