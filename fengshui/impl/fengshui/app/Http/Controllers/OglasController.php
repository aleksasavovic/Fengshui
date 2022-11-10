<?php
//Aleksa Savović 0387/15
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;  
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use DB;
use Image;

use App\Oglas;
use App\Prijavljeni;
use App\RadiNa;
//Samo za prikazivanje view-a postaviOglas
class OglasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct() {
        $this->middleware('auth');
    }
    //Sluzi za prikazivanje postaviOglas view-a
    //@return view('postaviOglas')
    public function index()
    {
    
        
        return view('postaviOglas');
    }
    

}
