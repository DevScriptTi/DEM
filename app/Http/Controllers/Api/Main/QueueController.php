<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Demand;
use App\Models\Api\Main\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QueueController extends Controller
{

    public function doctor_queues()
    {
        $queue = Queue::with('doctor')->withCount('demands')->paginate(6);
        return response()->json($queue);
    }

    public function index()
    {

        $queues = Queue::where('date', Carbon::today()->toDateString())
            ->with([
                'doctor' => [
                    'speciality',
                    'baladiya.wilaya'
                ],
                'demands' => function ($query) {
                    $query->with([
                        'patient' => function ($query) {
                            $query->with([
                                'prescriptions' => function ($query) {
                                    $query->whereDate('created_at', Carbon::today())
                                        ->where('doctor_id', Auth::user()->key->keyable_id)
                                        ->with('medicines');
                                },
                                'baladiya.wilaya'
                            ]);
                        }
                    ]);
                }
            ])
            ->withCount('demands')
            ->first();

        return response()->json($queues);
    }

    public function index_doctor()
    {
        $queues = Queue::where('date', Carbon::today()->toDateString())->with(['doctor' => function ($query) {
            $query->with('speciality', 'baladiya.wilaya');
        }])->withCount('demands')->paginate(40);
        return response()->json($queues);
    }

    public function current_demand(Request $request, Queue $queue)
    {

        $queue->current_demand_id = $request->current_demand_id;
        $queue->save();
        return response()->json([
            'message' => 'Current demand updated successfully',
            'queue' => $queue->load(
                [
                    'doctor' => [
                        'speciality',
                        'baladiya.wilaya'
                    ],
                    'demands' => [
                        'patient' => [
                            'prescriptions',
                            'baladiya.wilaya'
                        ]
                    ]
                ]
            )
        ], 200);
    }

    public function prescriptionStore(Request $request, Demand $demand)
    {
        $request->validate([
            'medicines' => 'required|array',
            'medicines.*.name' => 'required|string',
            'medicines.*.description' => 'required|string',
        ]);

        $patient = $demand->patient;
        $prescription = $patient->prescriptions()->create([
            'date' => Carbon::today(),
            'doctor_id' => Auth::user()->key->keyable_id,
            'patient_id' => $patient->id
        ]);

        $medicines = collect($request->medicines)->map(function ($medicine) {
            return [
                'name' => $medicine['name'],
                'description' => $medicine['description'],
            ];
        });

        $prescription->medicines()->createMany($medicines->toArray());

        $queue = $demand->queue;

        return response()->json($queue->load(
            [
                'doctor' => [
                    'speciality',
                    'baladiya.wilaya'
                ],
                'demands' => function ($query) {
                    $query->with([
                        'patient' => function ($query) {
                            $query->with([
                                'prescriptions' => function ($query) {
                                    $query->whereDate('created_at', Carbon::today())
                                        ->where('doctor_id', Auth::user()->key->keyable_id)
                                        ->with('medicines');
                                },
                                'baladiya.wilaya'
                            ]);
                        }
                    ]);
                }
            ]
        ), 201);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
        ]);

        $queue = Queue::create([
            'date' => $validated['date'],
            'doctor_id' => Auth::user()->key->keyable_id,
        ]);
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
