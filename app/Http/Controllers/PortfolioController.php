<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\PortfolioResource;
use App\Http\Requests\Portfolio\SavePortfolioRequest;


class PortfolioController extends Controller
{
    public function get(Request $request) {
        return new PortfolioResource($request->user());
    }
    
    public function save(SavePortfolioRequest $request) {
        $user = $request->user();

        $user->update($request->only(['first_name', 'last_name', 'contact_email', 'location', 'about', 'banner']));

        $user->educations()->delete();
        $user->educations()->createMany($request->input('educations', []));

        $user->projects()->delete();
        $user->projects()->createMany($request->input('projects', []));

        $user->skills()->delete();
        $user->skills()->createMany(array_map(fn($s) => [
            'name' => $s['name'],
            'level' => $s['level'] ?? null,
            'experience' => $s['experience'] ?? null,
            'icon' => $s['icon'] ?? null,
            'sub_skills' => $s['sub_skills'] ?? [],
        ], $request->input('skills', [])));

        return response()->json(['message' => 'Portfolio saved successfully']);
    }
}
