<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Api\Core\Baladiya;
use Illuminate\Http\Request;

class BaladiyaController extends Controller
{
    public function index()
    {
        $baladiyas = Baladiya::with('wilaya')->paginate(10);
        return response()->json($baladiyas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wilaya_id' => 'required|exists:wilayas,id'
        ]);
        $baladiya = Baladiya::create($validated);
        return response()->json($baladiya->load('wilaya'), 201);
    }

    public function show(Baladiya $baladiya)
    {
        return response()->json($baladiya->load('wilaya'));
    }

    public function update(Request $request, Baladiya $baladiya)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wilaya_id' => 'required|exists:wilayas,id'
        ]);
        $baladiya->update($validated);
        return response()->json($baladiya->load('wilaya'));
    }

    public function destroy(Baladiya $baladiya)
    {
        $baladiya->delete();
        return response()->json(null, 204);
    }
}
