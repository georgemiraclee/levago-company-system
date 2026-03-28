<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:255',
            'service' => 'nullable|string|max:255',
            'needs'   => 'nullable|string|max:2000',
        ]);

        Lead::create([
            ...$validated,
            'status' => 'new',
            'source' => 'website',
            'notes'  => $validated['needs'] ?? null,
        ]);

        return back()->with('success', 'Pesan kamu berhasil terkirim! Kami akan menghubungi dalam 1×24 jam.');
    }
}