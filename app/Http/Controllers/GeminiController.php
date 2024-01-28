<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GeminiAPI\Laravel\Facades\Gemini;

class GeminiController extends Controller
{
    public function genText()
    {
        $number = 15;
        $sentense = "I have headache.";
        $disease = "headache";
        $response = Gemini::generateText("Create an array of ".$number. " "  . $disease.  " sentences for Dialogflow training phrases, use this sentence '".$sentense."' as guide. Then separate them with commas, like this: sentence1, sentence2, ...");

        dd($response);
    }
}
