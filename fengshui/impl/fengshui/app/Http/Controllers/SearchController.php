<?php
//Ivana Dragutinović 0652/2015
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User;
use DB;

class SearchController extends Controller
{
    /**
     * Pretraga korisniku na osnovu imena, prezimena ili imena i prezimena zajedno
     *
     * @return view('profiles.search')
     */
    public function search(request $request) {      

        $req = $request->get('search');
        /*$str = explode(" ", $req);  
        if (count($str)<2) {
            $users = User::where('ime', $str[0])->get();
            if ($users == null)
                 $users = User::where('prezime', $str[0])->get();
        }
        else {
            $ime = $str[0];
            $prez = $str[1];   
            $users = DB::table('users')->select(DB::raw("*"))->where([
                ['ime', '=', $ime],
                ['prezime', '=', $prez],
            ])->get();

        }*/
        $users =  DB::select(DB::raw("SELECT * FROM users 
        WHERE CONCAT(ime, ' ', prezime) LIKE '%$req%' OR ime LIKE '%$req%' OR prezime LIKE '%$req%'"));

        return view('profiles.search')->with('users', $users);
    }


   
}
