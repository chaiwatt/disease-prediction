<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use App\DialogFlow\DialogFlow;
use GeminiAPI\Laravel\Facades\Gemini;

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

        // dd($trainingPhraseParts);

        $diablogFlow = new DialogFlow();
        $response = $diablogFlow->createIntent($trainingPhraseParts,$displayName,$messageTexts);
        $symptom = Symptom::where('name',$symptomName)->first();
        if($symptom !== null){
            $symptom->delete();
        }
        Symptom::create([
            'name' => $symptomName,
            'intent' => $displayName,
            'training_phrase' => json_encode($trainingPhraseParts)
        ]);
        return $response;
    }

    public function delete($id)
    {
        $symptom = Symptom::find($id);
        $diablogFlow = new DialogFlow();
        $response = $diablogFlow->deleteIntent($symptom->intent);
        Symptom::find($id)->delete();
        return redirect()->back();
    }

    public function genPhrase(Request $request)
    {
        $prompt = $request->data['prompt'];
        $response = Gemini::generateText($prompt);
        // dd($response);
        return $response;
    }

    public function view(Request $request)
    {
        $symptomId = $request->data['symptomId'];
        $symptom = Symptom::find($symptomId);
        
        return response()->json(['message' =>json_decode($symptom->training_phrase, true)]);
    }
}
