<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\Users\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['baladiya.wilaya', 'key.user', 'photo', 'speciality'])
                        ->paginate(10);
        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:doctors',
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:doctors',
            'baladiya_id' => 'required|exists:baladiyas,id',
            'speciality_id' => 'required|exists:specialities,id',
            'description' => 'nullable|string',
            'status' => 'required|in:offline,online'
        ]);

        $doctor = Doctor::create($validated);
        return response()->json($doctor->load(['baladiya.wilaya', 'key.user', 'photo']), 201);
    }

    public function show(Doctor $doctor)
    {
        return response()->json($doctor->load(['baladiya.wilaya', 'key.user', 'photo', 'speciality']));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|max:255|unique:doctors,username,'.$doctor->id,
            'name' => 'sometimes|string|max:255',
            'last' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'phone' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:doctors,email,'.$doctor->id,
            'baladiya_id' => 'sometimes|exists:baladiyas,id',
            'speciality_id' => 'sometimes|exists:specialities,id',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:offline,online'
        ]);

        $doctor->update($validated);
        return response()->json($doctor->load(['baladiya.wilaya', 'key.user', 'photo', 'speciality']));
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(null, 204);
    }
}
