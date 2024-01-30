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
        $disease = $request->data['disease'];
        $description = $request->data['description'];
        $url = $request->data['url'];
        $disease = Disease::create([
            'name' => $disease,
            'description' => $description,
            'url' => $url,
        ]);
        
        return response()->json($disease);
    }

    public function deleteDisease($id)
    {
        Disease::find($id)->delete();
        
        return redirect()->back();
    }

    public function getDisease(Request $request)
    {
        $disease = Disease::find($request->data['diseaseId']);
        return response()->json($disease);
    }

    public function updateDisease(Request $request)
    {
        $diseaseId = $request->data['diseaseId'];
        $name = $request->data['disease'];
        $description = $request->data['description'];
        $url = $request->data['url'];

        $disease = Disease::find($diseaseId)->update([
            'name' => $name,
            'description' => $description,
            'url' => $url,
        ]);

        return response()->json($disease);

    }
}
