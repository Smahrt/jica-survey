<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MainController extends Controller
{
    
    public static function showNumRows($table){
        $result = DB::table($table)->count();
        echo $result;
    }
    
    public static function showContactGroups($contact_type_id){
         $value = explode(",",$contact_type_id);
         $length = count($value);
         
         $i = 0;
         $cti="";
         while($i<$length){
             $rest = DB::select("SELECT * FROM contact_type WHERE id =$value[$i]");
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
        // show the form
       // return View::make('login');
    }

    /*public function doLogin(){
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
    return Redirect::to('login')
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
} else {

    // create our user data for the authentication
    $userdata = array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password')
    );

    // attempt to do the login
    if (Auth::attempt($userdata)) {

        // validation successful!
        // redirect them to the secure section or whatever
        // return Redirect::to('secure');
        // for now we'll just echo success (even though echoing in a controller is bad)
        echo 'SUCCESS!';

    } 
            else {        

        // validation not successful, send back to form 
        return Redirect::to('login');

    }

}
}*/
    
    public function doLogin(){
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
            
            $query_em = DB::select("SELECT * FROM users WHERE email ='$email'");
            $email_query[]="";
            
            $length = count($query_em);
            if($length == 0){
                
                $error_message = "Username/Password Invalid";
                return view('pages.login',['error_message' => $error_message]);
            }
            else{
                $query_pass =DB::select("SELECT password FROM users WHERE email ='$email' ");
                
                foreach($query_pass as $queriedPassword){
                    $userPass = $queriedPassword->password;
                }
                
                if($userPass == $password){
                    return view('pages.dashboard');
                }
                else{
                  $error_message = "Username/ Invalid".$userPass;
                    return view('pages.login',['error_message' => $error_message]);
                        
                }
                
            }
        }
    }
    
}
    
