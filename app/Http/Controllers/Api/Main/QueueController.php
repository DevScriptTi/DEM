<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::with(['doctor', 'demands'])->withCount('demands')->paginate(10);
        return response()->json($queues);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'doctor_id' => 'required|exists:doctors,id',
            'current_demand_id' => 'nullable|exists:demands,id'
        ]);

        $queue = Queue::create($validated);
        return response()->json($queue->load(['doctor', 'demands']), 201);
    }

    public function show(Queue $queue)
    {
        return response()->json([
            'queue' => $queue->load(['doctor']),
            'demands_count' => $queue->demands()->count(),
            'demands' => $queue->demands()->paginate(10)
        ]);
    }

    public function update(Request $request, Queue $queue)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'doctor_id' => 'required|exists:doctors,id',
            'current_demand_id' => 'nullable|exists:demands,id'
        ]);

        $queue->update($validated);
        return response()->json($queue->load(['doctor', 'demands']));
    }

    public function destroy(Queue $queue)
    {
        $queue->delete();
        return response()->json(null, 204);
    }
}
