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
        $value = $_COOKIE['login'];
        if($value == "login"){
            return view('pages.dashboard');

        }else{
            //echo "Session cannot find You";
            //return redirect()->route('signin');
            //return view('pages.login');
            return redirect('signin');
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

                    //updating user_sessions table
                    $mytime = Carbon\Carbon::now();
                    $time = $mytime->toDateTimeString();
                    
                    DB::connection('mysql')->select("Insert INTO user_sessions (user_id, email, date) VALUES ('$id','$email','$time')");
                    //end
                    
                    //setting a cookie
                        setcookie("login","login");
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
    
    public function createContact(Request $request){
        $lga = $request->input('lga');
        $desig = $request->input('designation');
        $phc = $request->input('phc_name');
        $officer = $request->input('officer_name');
        $phone = $request->input('phone_number');
        $contact_t= $request->input('contact_type_id');
        
        DB::connection('mysql2')->insert('INSERT INTO contacts (lga, designation, phc_name, officer_name, phone_number, contact_type_id, user_id, deleted, sms_last_wished_year, email_last_wished_year) values(?,?,?,?,?,?,?,?,?,?)',[$lga,$desig,$phc,$officer,$phone,$contact_t,'1','1','0000','0000']);
        
        $success_message = "Contact Created Successfully";
        
        //return Redirect('contacts')->with(['success_message',$success_message]);
        return view('pages.contacts',['success_message' => $success_message]);
    }
    
    public function showContact(Request $request){
        $id = $request->cid;
        $getcon = DB::connection('mysql2')->select('SELECT * FROM contacts where id =?', [$id]);
        //return view('pages.contacts',['contact'=>$getcon]);
        $contact = array();
        
        foreach($getcon as $con){
            $contact[0] = $con->lga;
            $contact[1] = $con->designation;
            $contact[2] = $con->phc_name;
            $contact[3] = $con->officer_name;
            $contact[4] = $con->phone_number;
        }
       return response()->json(['gc'=>$contact]);
    }   
    
    public function editContact(Request $request, $id){
        $phc = $request->input('phc_name');
        $officer = $request->input('officer_name');
        $phone = $request->input('phone_number'); 
        
        DB::connection('mysql2')->update("UPDATE contacts SET phc_name='$phc', officer_name='$officer', phone_number='$phone'  WHERE id ='$id'");
        
        $success_message = "Contact Updated Successfully";
        return Redirect('contacts');
        //return Redirect('contacts')->with('success_message',['Contact Updated Successfully']);
        //return view('pages.contacts',['success_message' => $success_message]);
        
        
    }

    public function deleteContact($id){ 
        
        DB::connection('mysql2')->delete('DELETE FROM contacts where id =?',[$id]);
        
        $success_message = "Contact Deleted Successfully";
        return Redirect('contacts');
        //return view('pages.contacts',['success_message' => $success_message]);
        
        
    }
    
    public function showLogout(){
       setcookie("login","logout");
        return redirect('/');   
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
    
    
}
    
