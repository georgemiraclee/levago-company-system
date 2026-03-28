<?php
// ============================================================
// app/Http/Controllers/AboutController.php
// ============================================================
namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        return view('web.about');
    }
}