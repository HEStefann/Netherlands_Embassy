<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        return response()->json(Interest::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:interests,name'
        ]);

        $interest = Interest::create($data);
        return response()->json($interest, 201);
    }

    public function show(Interest $interest)
    {
        return response()->json($interest);
    }

    public function update(Request $request, Interest $interest)
    {
        $data = $request->validate([
            'name' => 'string|unique:interests,name'
        ]);

        $interest->update($data);
        return response()->json($interest);
    }

    public function destroy(Interest $interest)
    {
        $interest->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
