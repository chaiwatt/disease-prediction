<?php

namespace App\DialogFlow;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Google\ApiCore\ApiException;
use Google\Cloud\Dialogflow\V2\Intent;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\EntityType;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\QueryResult;
use Google\Cloud\Dialogflow\V2\AudioEncoding;
use Google\Cloud\Dialogflow\V2\IntentsClient;
use Google\Cloud\Dialogflow\V2\ContextsClient;
use Google\Cloud\Dialogflow\V2\Intent\Message;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\EntityType\Kind;
use Google\Cloud\Dialogflow\V2\InputAudioConfig;
use Google\Cloud\Dialogflow\V2\Intent\Parameter;
use Google\Cloud\Dialogflow\V2\EntityType\Entity;
use Google\Cloud\Dialogflow\V2\EntityTypesClient;
use Google\Cloud\Dialogflow\V2\Intent\Message\Text;
use Google\Cloud\Dialogflow\V2\Intent\TrainingPhrase;
use Google\Cloud\Dialogflow\V2\SessionEntityTypesClient;
use Google\Cloud\Dialogflow\V2\Intent\FollowupIntentInfo;
use Google\Cloud\Dialogflow\V2\Intent\TrainingPhrase\Part;


class DialogFlow
{
    // สามารถเพิ่ม properties หรือ methods ต่าง ๆ ได้ตามต้องการ

    public function __construct()
    {
        $filePath = public_path(env('DIALOGFLOW_CREDENTIALS_JSON'));
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $filePath);
    }

    public function createIntent($trainingPhraseParts,$displayName,$messageTexts)
    {

        $this->deleteIntent($displayName);

        $response = $this->newIntent($displayName,$trainingPhraseParts,$messageTexts);
        return $response;
    }

    
    public function newIntent($displayName, $trainingPhraseParts, $messageTexts)
    {
        try {
            $projectId = env('DIALOGFLOW_PROJECT_ID');
            $languageCode = env('DIALOGFLOW_LANGUAGE_CODE');

            $intentsClient = new IntentsClient();
            $parent = $intentsClient->agentName($projectId, $languageCode);

            // prepare training phrases for intent
            $trainingPhrases = [];
            foreach ($trainingPhraseParts as $trainingPhrasePart) {
                $part = (new Part())->setText($trainingPhrasePart);
                $trainingPhrase = (new TrainingPhrase())->setParts([$part]);
                $trainingPhrases[] = $trainingPhrase;
            }

            // prepare messages for intent
            $text = (new Text())->setText($messageTexts);
            $message = (new Message())->setText($text);

            // prepare intent
            $weatherIntent = (new Intent())
                ->setDisplayName($displayName)
                ->setTrainingPhrases($trainingPhrases)
                ->setMessages([$message]);

            // create intent
            $response = $intentsClient->createIntent($parent, $weatherIntent);

            $intentsClient->close();


            return response()->json([
                    'successful' => $response->getName(),
                ], 200);
            } catch (ApiException $e) {
                $errorDetails = json_decode($e->getMessage(), true);

                if (isset($errorDetails['message'])) {
                    return response()->json([
                        'error' => $errorDetails['message'],
                    ], 400); // You can adjust the status code accordingly
                } else {
                    return response()->json([
                        'error' => 'An unexpected error occurred: ' . $e->getMessage(),
                    ], 500);
                }
            } catch (Exception $e) {
                return response()->json([
                    'error' => 'An unexpected error occurred: ' . $e->getMessage(),
                ], 500);
            }
    }

    public function deleteIntent($intentName)
    {
        try {
            $projectId = env('DIALOGFLOW_PROJECT_ID');
            $intentDisplayName = $intentName;
            $intentsClient = new IntentsClient();
            $parent = $intentsClient->agentName($projectId);
            $intents = $intentsClient->listIntents($parent);
            $uuid = null;
            foreach ($intents->iterateAllElements() as $intent) {
                 if($intent->getDisplayName() == $intentDisplayName){
                    $intentName = (string) $intent->getName();
                    $uuid = substr($intentName, strrpos($intentName, '/') + 1);
                    break;
                 }
            }

            $intentName = $intentsClient->intentName($projectId, $uuid);
            $intentsClient->deleteIntent($intentName);

            return response()->json([
                        'successful' => $intentName . 'deleted',
                    ], 200);
        } catch (ApiException $e) {
            $errorDetails = json_decode($e->getMessage(), true);

            if (isset($errorDetails['message'])) {
                return response()->json([
                    'error' => $errorDetails['message'],
                ], 400); // You can adjust the status code accordingly
            } else {
                return response()->json([
                    'error' => 'An unexpected error occurred: ' . $e->getMessage(),
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteAllIntent()
    {
        try {
            $projectId = env('DIALOGFLOW_PROJECT_ID');
            $intentsClient = new IntentsClient();
            $parent = $intentsClient->agentName($projectId);
            $intents = $intentsClient->listIntents($parent);
            $uuid = null;
            foreach ($intents->iterateAllElements() as $intent) {
                $intentName = (string) $intent->getName();
                $uuid = substr($intentName, strrpos($intentName, '/') + 1);
                $intentName = $intentsClient->intentName($projectId, $uuid);
                $intentsClient->deleteIntent($intentName);
            }

            return response()->json([
                        'successful' => $intentName . 'deleted',
                    ], 200);
        } catch (ApiException $e) {
            $errorDetails = json_decode($e->getMessage(), true);

            if (isset($errorDetails['message'])) {
                return response()->json([
                    'error' => $errorDetails['message'],
                ], 400); // You can adjust the status code accordingly
            } else {
                return response()->json([
                    'error' => 'An unexpected error occurred: ' . $e->getMessage(),
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function detectIntentText($message)
    {
        $projectId = env('DIALOGFLOW_PROJECT_ID');
        $languageCode = env('DIALOGFLOW_LANGUAGE_CODE');
        
        $text = $message;
        $sessionId = 'session-123';
        // new session
        $sessionsClient = new SessionsClient();
        $session = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());

        // echo($session);

        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        // create query input
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        try {
            $response = $sessionsClient->detectIntent($session, $queryInput); 

            $queryResult = $response->getQueryResult();
            $queryText = $queryResult->getQueryText();
            $intent = $queryResult->getIntent();
            $displayName = $intent->getDisplayName();
            $confidence = $queryResult->getIntentDetectionConfidence();
            $fulfilmentText = $queryResult->getFulfillmentText();
            $lgCode = $queryResult->getLanguageCode();


            $result = [
                "queryText" => $queryText,
                "intentBot" => $displayName,
                "confidence" => $confidence,
                "fulfilmentText" => $fulfilmentText,
                "languageCode" => $lgCode,

            ];
            
            $sessionsClient->close($session);
            return response()->json([
                        'message' => $result,
                    ], 200);
        } catch (ApiException $e) {
            $errorDetails = json_decode($e->getMessage(), true);

            if (isset($errorDetails['message'])) {
                return response()->json([
                    'error' => $errorDetails['message'],
                ], 400); // You can adjust the status code accordingly
            } else {
                return response()->json([
                    'error' => 'An unexpected error occurred: ' . $e->getMessage(),
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
   
    }



}
