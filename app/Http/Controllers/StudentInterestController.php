<?php

namespace App\Http\Controllers;

use App\Models\StudentInterest;
use Illuminate\Http\Request;

class StudentInterestController extends Controller
{
    public function index()
    {
        return StudentInterest::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'interest_id' => 'required|exists:interests,id',
        ]);

        $exists = StudentInterest::where('user_id', $request->user_id)
                                ->where('interest_id', $request->interest_id)
                                ->exists();

        if (!$exists) {
            $studentInterest = StudentInterest::create($request->all());
            return response()->json($studentInterest, 201);
        }

        return response()->json(['message' => 'Duplicate entry'], 400);
    }

    public function show($id)
    {
        return StudentInterest::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $studentInterest = StudentInterest::findOrFail($id);
        $studentInterest->update($request->all());
        return response()->json($studentInterest);
    }

    public function destroy($id)
    {
        $studentInterest = StudentInterest::findOrFail($id);
        $studentInterest->delete();
        return response()->json(null, 204);
    }
}
