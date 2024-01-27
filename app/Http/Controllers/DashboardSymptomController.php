<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use App\DialogFlow\DialogFlow;

class DashboardSymptomController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::all();
        return view('dashboard.symptom.index',[
            'symptoms' => $symptoms
        ]);
    }
    public function create()
    {
        return view('dashboard.symptom.create');
    }

    public function store(Request $request)
    {
        $symptomName = $request->data['symptom'];
        $trainingPhraseParts = $request->data['phrases'];
        $displayName = str_replace(' ', '_', $symptomName);
        $messageTexts = [$symptomName];

        $diablogFlow = new DialogFlow();
        $response = $diablogFlow->createIntent($trainingPhraseParts,$displayName,$messageTexts);
        $symptom = Symptom::where('name',$symptomName)->first();
        if($symptom !== null){
            $symptom->delete();
        }
        Symptom::create([
            'name' => $symptomName,
            'intent' => $displayName,
        ]);
        return $response;
    }

    public function delete($id)
    {
        $symptom = Symptom::find($id);
        $diablogFlow = new DialogFlow();
        $response = $diablogFlow->deleteIntent($symptom->intent);
        Symptom::find($id)->delete();
        // dd($response);
        return redirect()->back();
    }
}
