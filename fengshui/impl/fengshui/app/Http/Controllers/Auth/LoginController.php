<?php
//Ivana Dragutinović 0652/15
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    | Kontroler koji obavlja posao u vezi sa autentifikacijom korisnika i otvara im home stranicu.
    | 
   
    */

    use AuthenticatesUsers;

    /**
     *
     *ozancava koju stranicu otvoriti nakon logina
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
