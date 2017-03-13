<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DB;
//use Request;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
//use Session;
use Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
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
    
    public function showLogin(){
        if (Auth::check())
            {
                return Redirect('dashboard');
                
            }
    }

    public function verifyUser(){
        //checking if there is a session already
        if(session()->has('first_name')){
            return redirect()->route('dashboard');

        }else{
            return redirect()->route('login');
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
            return Redirect::to('login')
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
                    //--------------------------
                    $mytime = Carbon\Carbon::now();
                    $time = $mytime->toDateTimeString();
                    
                    DB::connection('mysql')->select("Insert INTO user_sessions (user_id, email, date) VALUES ('$id','$email','$time')");
                    //------------------------------
                    
                    //----------------------------
                        $request->session()->put('first_name','$userName');
                    //-----------------------------
                    //return view('pages.dashboard',['userName'=>$userName]);
                    return redirect()->route('dashboard', ['userName'=>$userName]);
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

    /*public function authenticate() {
        if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])){
            return redirect()->intended('dashboard');
        }else{
            return view('login');
        }
        
    }*/
    
    
    
}
    
