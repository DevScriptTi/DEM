<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\Users\DoctorHelper;
use Illuminate\Http\Request;

class DoctorHelperController extends Controller
{
    public function index()
    {
        $helpers = DoctorHelper::with(['doctor.baladiya.wilaya', 'key.user', 'photo'])->paginate(10);
        return response()->json($helpers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:doctor_helpers',
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:doctor_helpers',
            'doctor_id' => 'required|exists:doctors,id'
        ]);

        $helper = DoctorHelper::create($validated);
        return response()->json($helper->load(['doctor.baladiya.wilaya', 'key.user', 'photo']), 201);
    }

    public function show(DoctorHelper $doctorHelper)
    {
        return response()->json($doctorHelper->load(['doctor.baladiya.wilaya', 'key.user', 'photo']));
    }

    public function update(Request $request, DoctorHelper $doctorHelper)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|max:255|unique:doctor_helpers,username,'.$doctorHelper->id,
            'name' => 'sometimes|string|max:255',
            'last' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'phone' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:doctor_helpers,email,'.$doctorHelper->id,
            'doctor_id' => 'sometimes|exists:doctors,id'
        ]);

        $doctorHelper->update($validated);
        return response()->json($doctorHelper->load(['doctor.baladiya.wilaya', 'key.user', 'photo']));
    }

    public function destroy(DoctorHelper $doctorHelper)
    {
        $doctorHelper->delete();
        return response()->json(null, 204);
    }
}
