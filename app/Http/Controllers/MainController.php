<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function getContacts(){
       $result = DB::select('SELECT * FROM contacts JOIN contact_type ON contacts.contact_type_id = contact_type.id');
       return view('pages.contacts', ['result'=>$result]);
    }
    
    public static function getContactsQuery(){
       $result = DB::select('SELECT * FROM contacts JOIN contact_type ON contacts.contact_type_id = contact_type.id');
        return view('layouts.master', ['result'=>$result]);
    }
    
    public static function getContactType(){
       $res_type = DB::select('SELECT * FROM contact_type');
        return view('layouts.master', ['res_type'=>$res_type]);
    }
    
    
    public function getSurveys(){
        $result = DB::select('SELECT * FROM surveys');
        return view('pages.surveys', ['result'=>$result]);
    }
    
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
    
    
}