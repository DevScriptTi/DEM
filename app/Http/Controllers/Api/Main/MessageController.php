<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['doctor', 'patient'])->paginate(10);
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id'
        ]);

        $message = Message::create($validated);
        return response()->json($message->load(['doctor', 'patient']), 201);
    }

    public function show(Message $message)
    {
        return response()->json($message->load(['doctor', 'patient']));
    }

    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id'
        ]);

        $message->update($validated);
        return response()->json($message->load(['doctor', 'patient']));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(null, 204);
    }
}
