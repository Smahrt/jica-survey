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

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'MainController@showDashboard']);
Route::get('logout', ['as' => 'signin', 'uses' => 'MainController@showLogout']);
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
Route::get('/',function () {
    return redirect('dashboard');
});

Route::get('signin',function () {
    setcookie("login","boy");
    return view('pages.login');
});

// route to process the form
Route::post('/signin', array('uses' => 'MainController@doLogin'));

// route to the show-contacts page
Route::post('/edit', array('uses' => 'MainController@showContact'));

// route to the view-create-contacts page
Route::get('create', array('uses' => 'MainController@viewCreate'));

// route to the create-contacts page
Route::post('insert', array('uses' => 'MainController@createContact'));

// route to the Delete-contacts page
Route::get('/delete/{id}', array('uses' => 'MainController@deleteContact'));

// route to the Edit-contacts page
Route::post('/edit/{id}', array('uses' => 'MainController@editContact'));

//Route to handle survey form on submit
Route::post('/save-tts-survey', array('uses' => 'MainController@saveSurveyTTS'));
Route::post('/save-record-survey', array('uses' => 'MainController@saveSurveyRecord'));

//route to show the contact table
Route::get('/response', array('uses' => 'MainController@showviewResponse'));

