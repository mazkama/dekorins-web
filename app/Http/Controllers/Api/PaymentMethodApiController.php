<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentMethodApiController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::all();

        return response()->json([
            'success' => true,
            'message' => 'List payment methods',
            'data' => $methods
        ], 200);
    }
}