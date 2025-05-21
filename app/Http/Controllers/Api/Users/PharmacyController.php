<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\Users\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::with(['baladiya.wilaya', 'key.user', 'photo'])->paginate(10);
        return response()->json($pharmacies);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:pharmacies',
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'pharmacy_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pharmacies',
            'baladiya_id' => 'required|exists:baladiyas,id'
        ]);

        $pharmacy = Pharmacy::create($validated);
        return response()->json($pharmacy->load(['baladiya.wilaya', 'key.user', 'photo']), 201);
    }

    public function show(Pharmacy $pharmacy)
    {
        return response()->json($pharmacy->load(['baladiya.wilaya', 'key.user', 'photo']));
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|max:255|unique:pharmacies,username,'.$pharmacy->id,
            'name' => 'sometimes|string|max:255',
            'last' => 'sometimes|string|max:255',
            'pharmacy_name' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'phone' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:pharmacies,email,'.$pharmacy->id,
            'baladiya_id' => 'sometimes|exists:baladiyas,id'
        ]);

        $pharmacy->update($validated);
        return response()->json($pharmacy->load(['baladiya.wilaya', 'key.user', 'photo']));
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return response()->json(null, 204);
    }
}
