<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use App\DialogFlow\DialogFlow;

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
        return $response;
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

       $symptoms = $request->data['symptoms'];

        $someDiseaseWithSymptoms = Disease::whereHas('symptoms', function ($query) use ($symptoms) {
            $query->whereIn('symptoms.name', $symptoms);
        })->get();

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
