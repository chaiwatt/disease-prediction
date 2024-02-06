<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use App\DialogFlow\DialogFlow;
use Illuminate\Support\Facades\DB;

class ProcessingController extends Controller
{
    public function createIntent()
    {
        // $diablogFlow = new DialogFlow();
        // $diablogFlow->createIntent();
    }

    public function textDetection(Request $request)
    {
        $mesage = $request->data['message'];
        
        $diablogFlow = new DialogFlow();
        $response = $diablogFlow->detectIntentText($mesage);
        // dd($response->content());
        $responseData = json_decode($response->content(), true);

        if (isset($responseData['error'])) {
            $responseData = [
                "message" => [
                    "queryText" => null,
                    "intentBot" => null,
                    "confidence" => null,
                    "fulfilmentText" => null,
                    "languageCode" => "en",
                ],
            ];
        }
        return $responseData;
    }

    public function deleteIntent(Request $request)
    {
        $diablogFlow = new DialogFlow();
       
        $response = $diablogFlow->deleteIntent('headache');
        
        return $response;
    }

     public function deleteAllIntent(Request $request)
    {
        $diablogFlow = new DialogFlow();
       
        $response = $diablogFlow->deleteAllIntent();
        
        return $response;
    }

    public function diseaseMatching(Request $request)
    {
       $symptoms = $request->data['symptoms'];
        $someDiseaseWithSymptoms = Disease::whereHas('symptoms', function ($query) use ($symptoms) {
            $query->whereIn('symptoms.name', $symptoms);
        }, '>=', 1)->get();

        $minimumPercent = 10;
        $diseaseMatches = collect();
        foreach ($someDiseaseWithSymptoms as $disease) 
        {
            $diseaseSymptoms = $disease->symptoms;
            $matchedSymptoms = array_intersect($diseaseSymptoms->pluck('name')->toArray(), $symptoms);

            $percentNotMatch = (count($symptoms)-count($matchedSymptoms))/count($diseaseSymptoms)*100;
            $percentMatch = count($matchedSymptoms)/count($diseaseSymptoms)*100;

            if($percentMatch > $minimumPercent && $percentMatch > $percentNotMatch)
            {
                if ($matchedSymptoms) {
                    $matches = implode(', ', $matchedSymptoms);
                     $diseaseMatches->push([
                        'disease' => $disease,
                        'matches' => $matches,
                        'percent_match' => $percentMatch,
                    ]);
                } 
            }
        }

        return view('result-render.result', [
            'diseaseMatches' => $diseaseMatches,
        ])->render();
    }
    
}
