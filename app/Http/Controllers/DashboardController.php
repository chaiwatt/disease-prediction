<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $diseases = Disease::all();
        return view('dashboard.index',[
            'diseases' => $diseases
        ]);
    }

    public function storeDisease(Request $request)
    {
        $diesase = $request->data['disease'];
        $disease = Disease::create([
            'name' => $diesase
        ]);
        
        return response()->json($disease);
    }
}
