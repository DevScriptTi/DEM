<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\Users\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::with(['baladiya.wilaya', 'key.user', 'photo'])
            ->when($request->has('username'), function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->username . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'phone' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:patients',
            'baladiya_id' => 'sometimes|exists:baladiyas,id',
            'description' => 'nullable|string'
        ]);

        // Generate username from name and last name plus random chars
        $username = strtolower($request->name . $request->last . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 6));
        $validated['username'] = $username;
        Patient::create($validated);
        return response()->json([
            'message' => 'Patient created successfully',
        ], 201);
    }

    public function show(Patient $patient)
    {
        return response()->json([
            'message' => 'Patient fetched successfully',
            'patient' => $patient->load(['baladiya.wilaya', 'key.user', 'photo'])
        ], 200);
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'baladiya_id' => 'required|exists:baladiyas,id',
            'description' => 'nullable|string'
        ]);

        // Generate username from name and last name plus random chars
        $username = strtolower($request->name . $request->last . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 6));
        $validated['username'] = $username;

        $patient->update($validated);
        return response()->json([
            'message' => 'Patient updated successfully',
        ], 200);
    }

    public function createKey(Patient $patient)
    {
        $patient->key()->create([
            'value' => str()->random(10),
        ]);
        return response()->json([
            'message' => 'Key created successfully',           
        ], 201);
        
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json([
            'message' => 'Patient deleted successfully'
        ], 200);
    }
}
