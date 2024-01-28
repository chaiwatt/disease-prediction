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
        return redirect()->back();
    }

    public function genPhrase(Request $request)
    {
        $symtomp = $request->data['symptom'];
        $number = 15;
        $sentense = "I have " . $symtomp . ".";
        $response = Gemini::generateText("Create an array of ".$number. " "  . $symtomp.  " sentences for Dialogflow training phrases, use this sentence '".$sentense."' as guide. Then and end with\n and separate them with commas, like this: sentence1\n, sentence2\n, ...");
        return $response;
    }
}
