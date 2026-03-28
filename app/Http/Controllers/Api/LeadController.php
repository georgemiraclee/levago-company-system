<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string',
            'needs' => 'nullable|string',
        ]);

        $lead = Lead::create([
            ...$validated,
            'status' => 'new',
            'source' => 'website',
        ]);

        return response()->json(['message' => 'Lead berhasil disimpan!', 'data' => $lead], 201);
    }
}