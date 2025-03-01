<?php

namespace App\Http\Controllers;

use App\Models\StudentData;
use Illuminate\Http\Request;

class StudentDataController extends Controller
{
    public function index()
    {
        return response()->json(StudentData::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'grade' => 'required|string',
            'school' => 'required|string'
        ]);

        $studentData = StudentData::create($data);
        return response()->json($studentData, 201);
    }

    public function show(StudentData $studentData)
    {
        return response()->json($studentData);
    }

    public function update(Request $request, StudentData $studentData)
    {
        $data = $request->validate([
            'grade' => 'string',
            'school' => 'string'
        ]);

        $studentData->update($data);
        return response()->json($studentData);
    }

    public function destroy(StudentData $studentData)
    {
        $studentData->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
