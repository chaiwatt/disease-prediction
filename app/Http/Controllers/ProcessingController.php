<?php

namespace App\Http\Controllers;

use App\DialogFlow\DialogFlow;
use Illuminate\Http\Request;

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

    
}
