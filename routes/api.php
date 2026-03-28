<?php
use App\Http\Controllers\Api\LeadController;

Route::post('/leads', [LeadController::class, 'store']);