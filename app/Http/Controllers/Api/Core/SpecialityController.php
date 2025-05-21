<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Api\Core\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::withCount('doctors')->paginate(10);
        return response()->json($specialities);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $speciality = Speciality::create($validated);
        return response()->json($speciality, 201);
    }

    public function show(Speciality $speciality)
    {
        return response()->json([
            'speciality' => $speciality,
            'doctors_count' => $speciality->doctors()->count(),
            'doctors' => $speciality->doctors()->paginate(10)
        ]);
    }

    public function update(Request $request, Speciality $speciality)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $speciality->update($validated);
        return response()->json($speciality);
    }

    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        return response()->json(null, 204);
    }
}
