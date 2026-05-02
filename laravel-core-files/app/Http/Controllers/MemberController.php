<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with(['sports', 'payments', 'dependents'])->get();
        return response()->json($members);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'gender' => 'required|in:M,F',
            'dob' => 'required|date',
            'city' => 'nullable|string|max:50',
            'street' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:10',
        ]);

        $member = Member::create($validated);
        return response()->json($member, 201);
    }

    public function show($id)
    {
        $member = Member::with(['sports', 'payments', 'dependents'])->findOrFail($id);
        return response()->json($member);
    }
}
