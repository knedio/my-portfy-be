<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Resources\ProfessionResource;

class ProfessionController extends Controller
{
    /**
     * Display a listing of professions.
     */
    public function index()
    {
        $professions = Profession::all();
        return ProfessionResource::collection($professions);
    }

    /**
     * Store a newly created profession (if you want admin to add professions).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:professions,name',
            'is_other' => 'boolean',
        ]);

        $profession = Profession::create($validated);

        return new ProfessionResource($profession);
    }

    /**
     * Display the specified profession.
     */
    public function show(Profession $profession)
    {
        return new ProfessionResource($profession);
    }

    /**
     * Update the specified profession.
     */
    public function update(Request $request, Profession $profession)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:professions,name,' . $profession->id,
            'is_other' => 'boolean',
        ]);

        $profession->update($validated);

        return new ProfessionResource($profession);
    }

    /**
     * Remove the specified profession.
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();

        return response()->json(['message' => 'Profession deleted successfully']);
    }
}
