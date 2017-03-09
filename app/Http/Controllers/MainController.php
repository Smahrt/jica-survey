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
    
    /*public function getContactGroup(){
       $result = DB::select('SELECT type FROM contact_type');
       return view('pages.contacts', ['result'=>$result]);
    }*/
    
    public function getSurveys(){
        $result = DB::select('SELECT * FROM surveys');
        return view('pages.surveys', ['result'=>$result]);
    }
    
    public static function showNumRows($table){
        $result = DB::table($table)->count();
        echo $result;
    }
    
    
}