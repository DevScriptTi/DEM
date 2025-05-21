<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['doctor', 'patient', 'pharmacy', 'medicines'])
                                    ->paginate(10);
        return response()->json($prescriptions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id'
        ]);

        $prescription = Prescription::create($validated);
        return response()->json($prescription->load(['doctor', 'patient', 'pharmacy', 'medicines']), 201);
    }

    public function show(Prescription $prescription)
    {
        return response()->json([
            'prescription' => $prescription->load(['doctor', 'patient', 'pharmacy']),
            'medicines' => $prescription->medicines()->paginate(10)
        ]);
    }

    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id'
        ]);

        $prescription->update($validated);
        return response()->json($prescription->load(['doctor', 'patient', 'pharmacy', 'medicines']));
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return response()->json(null, 204);
    }
}
