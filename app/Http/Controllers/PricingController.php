<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        return view('web.pricing');
    }
}