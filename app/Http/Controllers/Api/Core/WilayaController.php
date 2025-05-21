<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Api\Core\Wilaya;
use Illuminate\Http\Request;

class WilayaController extends Controller
{
    public function index()
    {
        $wilayas = Wilaya::withCount('baladiyas')->paginate(10);
        return response()->json($wilayas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $wilaya = Wilaya::create($validated);
        return response()->json($wilaya, 201);
    }

    public function show(Wilaya $wilaya)
    {
        return response()->json([
            'wilaya' => $wilaya,
            'baladiyas_count' => $wilaya->baladiyas()->count(),
            'baladiyas' => $wilaya->baladiyas()->paginate(10)
        ]);
    }

    public function update(Request $request, Wilaya $wilaya)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $wilaya->update($validated);
        return response()->json($wilaya);
    }

    public function destroy(Wilaya $wilaya)
    {
        $wilaya->delete();
        return response()->json(null, 204);
    }
}
