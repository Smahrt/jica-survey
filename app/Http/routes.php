<?php

use Illuminate\Http\RedirectResponse;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Survey;

Route::post('/call',function(Request $request){
   if (!$request->session()->has('survey')) {

            session([
                'survey'=>$request->survey
            ]);
        }

    $AccountSid = "ACbbb2bdc97932964b709697702be99690";
    $AuthToken = "ee536c11385b0bd9864687b90f49cd41";
    $client = new Client($AccountSid, $AuthToken);

    try {
        // Initiate a new outbound call
        $call = $client->account->calls->create(
            $request->phone_number,
            "+17143619371",
            array("url" => "https://b401ae11.ngrok.io/voice/connect")
			
        );
        $success = "Started call to: " . $call->to;
    } catch (Exception $e) {
        $error =  "Error: " . $e->getMessage();
    }
});

Route::get(
    '/survey/{survey}/results',
    ['as' => 'survey.results', 'uses' => 'SurveyController@showResults']
);

Route::post(
    '/voice/connect',
    ['as' => 'voice.connect', 'uses' => 'SurveyController@connectVoice']
);
Route::post(
    '/sms/connect',
    ['as' => 'sms.connect', 'uses' => 'SurveyController@connectSms']
);
Route::get(
    '/survey/{id}/voice',
    ['as' => 'survey.show.voice', 'uses' => 'SurveyController@showVoice']
);
Route::get(
    '/survey/{id}/sms',
    ['as' => 'survey.show.sms', 'uses' => 'SurveyController@showSms']
);
Route::get(
    '/survey/{survey}/question/{question}/voice',
    ['as' => 'question.show.voice', 'uses' => 'QuestionController@showVoice']
);
Route::get(
    '/survey/{survey}/question/{question}/sms',
    ['as' => 'question.show.sms', 'uses' => 'QuestionController@showSms']
);
Route::post(
    '/survey/{survey}/question/{question}/response/voice',
    ['as' => 'response.store.voice', 'uses' => 'QuestionResponseController@storeVoice']
);
Route::post(
    '/survey/{survey}/question/{question}/response/sms',
    ['as' => 'response.store.sms', 'uses' => 'QuestionResponseController@storeSms']
);
Route::post(
    '/survey/{survey}/question/{question}/response/transcription',
    ['as' => 'response.transcription.store', 'uses' => 'QuestionResponseController@storeTranscription']
);

//My Routes

Route::get('/',function(){
    return view('pages.login');
});

Route::get('/login',function(){
    return view('pages.login');
});

Route::get('/dashboard',function(){
    return view('pages.dashboard');
});

Route::get('/contacts', function () {
    return view('pages.contacts');
});

Route::get('/surveys', function () {
    return view('pages.surveys');
});

Route::get('/create-new-survey', function () {
    return view('pages.create-new-survey');
});

//Login routes
// route to show the login form
//Route::get('login', array('uses' => 'MainController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'MainController@doLogin'));

