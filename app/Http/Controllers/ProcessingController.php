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

        // $someDiseaseWithSymptoms = Disease::whereHas('symptoms', function ($query) use ($symptoms) {
        //     $query->whereIn('symptoms.name', $symptoms);
        // })->get();

        $someDiseaseWithSymptoms = Disease::whereHas('symptoms', function ($query) use ($symptoms) {
            $query->whereIn('symptoms.name', $symptoms);
        }, '>=', 1)->get();


        $minimumPercent = 10;
        $diseaseMatches = collect();
        foreach ($someDiseaseWithSymptoms as $disease) 
        {
            $diseaseSymptoms = $disease->symptoms;
            $matchedSymptoms = array_intersect($diseaseSymptoms->pluck('name')->toArray(), $symptoms);

            // $missingSymptoms = array_diff($matchedSymptoms, $symptoms);

            $percentNotMatch = (count($symptoms)-count($matchedSymptoms))/count($diseaseSymptoms)*100;
            // dd($percentNotMatch);
            $percentMatch = count($matchedSymptoms)/count($diseaseSymptoms)*100;

            if($percentMatch > $minimumPercent && $percentMatch > $percentNotMatch)
            {
                if ($matchedSymptoms) {
                    $matches = implode(', ', $matchedSymptoms);
                    // $missingSymptoms = implode(', ', $missingSymptoms);
                     $diseaseMatches->push([
                        'disease' => $disease,
                        'matches' => $matches,
                        // 'miss_matches' => $missingSymptoms,
                        'percent_match' => $percentMatch,
                        // 'percent_not_match' => $percentNotMatch,
                    ]);
                } 
            }
        }

        return view('result-render.result', [
            'diseaseMatches' => $diseaseMatches,
            // 'someDiseaseWithSymptoms' => $someDiseaseWithSymptoms,
        ])->render();

        // dd($diseaseMatches[0]['percent']);



    // foreach ($someDiseaseWithSymptoms as $disease) {
    //     $totalSymptoms = $disease->symptoms->count();
    //     $minimumSymptomsToShow = ceil($totalSymptoms * 0.5);
        

    //     $someDiseaseWithSymptoms = disease::whereHas('symptoms', function ($query) use ($symptoms) {
    //         $query->whereIn('symptoms.name', $symptoms);
    //     })->pluck('symptoms.name');

    //     dd($someDiseaseWithSymptoms);

    //     // ตรวจสอบว่าจำนวนอาการมากกว่า minimumSymptomsToShow หรือไม่
    //     if ($disease->symptoms->count() >= $minimumSymptomsToShow) {
    //         // แสดง disease นี้
    //     }
    // }






return;
        dd($someDiseaseWithSymptoms);

        $allDiseaseWithSymptoms = Disease::whereHas('symptoms', function ($query) use ($symptoms) {
            $query->whereIn('symptoms.name', $symptoms);
        }, '=', count($symptoms))->get();


        // foreach ($diseaseWithSymptoms as $disease) {
        //     $disease->symptoms->each(function ($symptom) use ($symptoms,$disease) {
        //         echo($disease->name);
        //         if (in_array($symptom->name, $symptoms)) {
        //             echo "- {$symptom->name}\n";
        //         }
        //     });
        // }

       return view('result-render.result', [
            'allDiseaseWithSymptoms' => $allDiseaseWithSymptoms,
            'someDiseaseWithSymptoms' => $someDiseaseWithSymptoms,
        ])->render();

     
    }

    // public function diseaseMatching(Request $request)
    // {
    //     $symptoms = $request->data['symptoms'];

    //     $diseaseWithSymptoms = Disease::with(['symptoms' => function ($query) use ($symptoms) {
    //         $query->whereIn('name', $symptoms);
    //     }])->get();

    //     $sortedDiseases = $diseaseWithSymptoms->sortByDesc(function ($disease) use ($symptoms) {
    //         return $disease->symptoms->filter(function ($symptom) use ($symptoms) {
    //             return in_array($symptom->name, $symptoms);
    //         })->count();
    //     });

    //     // $sortedDiseases->each(function ($disease) use ($symptoms) {
    //     //     $disease->symptoms->each(function ($symptom) use ($symptoms, $disease) {
    //     //         if (in_array($symptom->name, $symptoms)) {
    //     //             echo "- {$symptom->name}\n";
    //     //         }
    //     //     });
    //     // });

    //     return view('result-render.result', ['sortedDiseases' => $sortedDiseases])->render();
    // }



    
}
