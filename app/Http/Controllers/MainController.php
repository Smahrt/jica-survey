<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DB;
//use Request;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Session;
use Carbon;
use Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
//use Illuminate\Support\Facades\Request;


class MainController extends Controller
{
    
    public static function showNumRows($table){
        if($table == "contacts" || $table == "contact_type"){
            $result = DB::connection('mysql2')->table($table)->count();
            echo $result;
        }else{
            $result = DB::connection('mysql')->table($table)->count();
            echo $result;
        }
    }
    
    public static function showContactGroups($contact_type_id){
         $value = explode(",",$contact_type_id);
         $length = count($value);
         
         $i = 0;
         $cti="";
         while($i<$length){
             $rest = DB::connection('mysql2')->select("SELECT * FROM contact_type WHERE id =$value[$i]");
             foreach($rest as $conType){
                 $res[] = $conType->type;
             }
             
             if ($i==($length-1)){
                 $cti.= $res[$i];
             }else{
                 $cti.= $res[$i].", ";
             }
             $i++;
         }
         echo $cti;
   
    }
    
    public function showDashboard(Request $request){
        //$_COOKIE['login']=="haha"
        $value = $_COOKIE['login'];
        if($value == "haha"){
            //return redirect()->route('');
            return view('pages.dashboard');

        }else{
            //echo "Session cannot find You";
            //return redirect()->route('signin');
            return view('pages.login');
        }
    }
    
    public function doLogin(Request $request){ 
        //create vaidation rules
        $rules = array(
            'email' => 'required|email',
            'password' =>'required|alphaNum|min:4'
        );
        
        //run this rules on the form input
        $validator = Validator::make(Input::all(),$rules);
        
        //conditions
        if ($validator->fails()){
            return Redirect::to('signin')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
       
        }
        else{
             $email= Input::get('email');
             $password= Input::get('password');
            
            $query_em = DB::connection('mysql')->select("SELECT * FROM users WHERE email ='$email'");
            $email_query[]="";
            

             foreach($query_em as $queryDetails){
                    $userName = $queryDetails->first_name;
                    $id = $queryDetails->id;
                }

            $length = count($query_em);
            if($length == 0){
                
                $error_message = "Email/Password Invalid";
                return view('pages.login',['error_message' => $error_message]);
            }
            else{
                $query_pass =DB::connection('mysql')->select("SELECT password FROM users WHERE email ='$email' ");
                
                foreach($query_pass as $queriedPassword){
                    $userPass = $queriedPassword->password;
                }
                
                if($userPass == $password){

                    //updating user_sessions table
                    $mytime = Carbon\Carbon::now();
                    $time = $mytime->toDateTimeString();
                    
                    DB::connection('mysql')->select("Insert INTO user_sessions (user_id, email, date) VALUES ('$id','$email','$time')");
                    //end
                    
                    //setting a cookie
                        setcookie("login","haha");
                    //end
                    
                    return redirect()->route('dashboard');
                }
                
                else{
                  $error_message = "Email/Password Invalid";

                    return view('pages.login',['error_message' => $error_message]);
                        
                }
                
            }
        }
        
        
    }
    
     public function viewCreate(){
        return view('pages.create-contacts');
    } 
    
    public function createContact(Request $request){
        $lga = $request->input('lga');
        $desig = $request->input('designation');
        $phc = $request->input('phc_name');
        $officer = $request->input('officer_name');
        $phone = $request->input('phone_number');
        $contact_t= $request->input('contact_type_id');
        
        DB::connection('mysql2')->insert('INSERT INTO contacts (lga, designation, phc_name, officer_name, phone_number, contact_type_id, user_id, deleted, sms_last_wished_year, email_last_wished_year) values(?,?,?,?,?,?,?,?,?,?)',[$lga,$desig,$phc,$officer,$phone,$contact_t,'1','1','0000','0000']);
        
        $success_message = "Contact Created Successfully";
        return view('pages.create-contacts',['success_message' => $success_message]);
    }
    
    public function showContact($id){
        $contact = DB::connection('mysql2')->select('SELECT * FROM contacts where id =?', [$id]);
        return view('pages.show-contacts',['contact'=>$contact]);
    }   
    
    public function editContact(Request $request, $id){
        $phc = $request->input('phc_name');
        $officer = $request->input('officer_name');
        $phone = $request->input('phone_number'); 
        
        DB::connection('mysql2')->update("UPDATE contacts SET phc_name='$phc', officer_name='$officer', phone_number='$phone'  WHERE id ='$id'");
        
        $success_message = "Contact Updated Successfully";
        return view('pages.contacts',['success_message' => $success_message]);
        
        
    }

    public function deleteContact($id){ 
        
        DB::connection('mysql2')->delete('DELETE FROM contacts where id =?',[$id]);
        
        $success_message = "Contact Deleted Successfully";
        return view('pages.contacts',['success_message' => $success_message]);
        
        
    }
    
    public function showLogout(){
       setcookie("login","BOY");
        return view('pages.logout');    
    }
    
    public function viewResponse(){
        return view('pages.view-response');
    }
    
    public function showviewResponse(){
        $phone[] ="";
        $i = 0;
        $num_query = DB::connection('mysql')->select("SELECT * FROM question_responses GROUP BY session_sid");
        foreach($num_query as $num){
            $phone[] = $num->$session_sid;
        }
        
        $length = count($phone);
        
        while($i<$length){
            $result = DB::connection('mysql')->select("SELECT * FROM question_responses WHERE session_sid = '$phone[$i]'");
            $storage[$i] =$result[$i];
        }
        
        return view('pages.view-response')->with('num_query',$num_query);
        
    }
    
    /** Handle survey save to database **/
    public function saveSurvey(Request $request){
            $intro = $request->surveyIntro;
            $title = $request->surveyTitle;
            $q_num = $request->last_survey_id;
            $type = $request->survey_type;
            $gli = DB::connection('mysql')->select("SELECT * FROM surveys"); //Select the last id in the survey table
            $gli_count = count($gli);
            $get_sid = $gli_count+1;
        
        if($type == "TTS"){
            echo $q_num;
            $mytime = Carbon\Carbon::now();
            $time = $mytime->toDateTimeString();

            DB::connection('mysql')->insert('INSERT INTO surveys(title,type,intro,created_at,updated_at) values(?,?,?,?,?)', [$title,$type, $intro,$time,$time]);
            
            if($get_sid == ""){
                echo "This is empty - ".$get_sid;
            }
            else{
                $i = 1;

                while($i <= $q_num){
                    $qname = "question_".$i;
                    $rname = "response_type_".$i;

                    $q = $request->$qname;
                    $r = $request->$rname;

                    DB::connection('mysql')->insert('INSERT INTO questions(body,kind,survey_id,created_at,updated_at) values(?,?,?,?,?)', [$q, $r, $get_sid, $time, $time]);
                    
                    $i++;
                }
                $info = "Survey has been successfully saved!";
            }
            return redirect()->back()->with('info', $info);
            
        }else if($type == "record"){
            
            
        }
        
    }
    
    public function uploadSurveyAudio(Request $request){
        $audio = $request->rawAudioData; //fetch the raw base64 data
        $id = $request->audio_id; //fetch the audio id
        $sid = $request->survey_id; //fetch the audio id
        
        $raw_audio = str_replace('data:audio/wav;base64,', '', $audio); //strip the base64 header
        $decoded = base64_decode($raw_audio); //decode base64
        
        $d = date("Y-m-d"); $t = date("h-i-s");
        
        $audio_url = "record-".$d.$t."-".$id.".wav";
        $path = public_path().'/assets/uploads/'.$audio_url;

        $fname = "test".".wav";
        $handle = fopen($path,'w');
        fwrite($handle, $decoded);
        fclose($handle);

        return response()->json(['res' => $path]);
    }
    
}
    
