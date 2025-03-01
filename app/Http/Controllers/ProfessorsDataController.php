<?php

namespace App\Http\Controllers;

use App\Models\ProfessorsData;
use Illuminate\Http\Request;

class ProfessorsDataController extends Controller
{
    public function index()
    {
        return response()->json(ProfessorsData::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department' => 'required|string',
            'bio' => 'nullable|string'
        ]);

        $professorData = ProfessorsData::create($data);
        return response()->json($professorData, 201);
    }

    public function show(ProfessorsData $professorsData)
    {
        return response()->json($professorsData);
    }

    public function update(Request $request, ProfessorsData $professorsData)
    {
        $data = $request->validate([
            'department' => 'string',
            'bio' => 'nullable|string'
        ]);

        $professorsData->update($data);
        return response()->json($professorsData);
    }

    public function destroy(ProfessorsData $professorsData)
    {
        $professorsData->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
