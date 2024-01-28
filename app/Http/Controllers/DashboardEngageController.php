<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Http\Request;

class DashboardEngageController extends Controller
{
    public function index($id)
    {
        $symptoms = Symptom::all();
        $disease = Disease::find($id);
        return view('dashboard.disease.engage.index',[
            'disease' => $disease,
            'symptoms' => $symptoms
        ]);
    }

    public function assign(Request $request)
    {
        $diseaseId = $request->data['diseaseId'];
        $symptomId = $request->data['symptom'];

        $existingRelation = Disease::find($diseaseId)->symptoms()->where('symptom_id', $symptomId)->exists();

        if (!$existingRelation) {
            Disease::find($diseaseId)->symptoms()->syncWithoutDetaching([$symptomId]);
        }

        return response()->json(['message' => 'Assignment successful']);
    }
}
