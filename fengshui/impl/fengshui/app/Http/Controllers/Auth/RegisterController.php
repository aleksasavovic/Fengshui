<?php
//Ivana Dragutinović 0652/15
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Kontroler koji izvrsava registraciju novih korisnika veb aplikacije.
    |
    */

    use RegistersUsers;

    /**
     * Oznava stranicu koja treba da se otvori nakon registracije
     *
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
        $this->middleware('guest');
    }

    /**
     * Vrsi validaciju novog zahteva
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ime' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'prezime' => 'required|string|max:255',
            'korisnicko' => 'required|string|max:255',
            'tipKorisnika' => 'required|string|max:255',
            'opis' => 'required|string|max:255',
        ]);
    }

    /**
     * Kreiranje novog korisnika
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {       
        return User::create([
            'ime' => $data['ime'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'prezime' => $data['prezime'],
            'korisnicko' => $data['korisnicko'],
            'tipKorisnika' => $data['tipKorisnika'],
            'opis' => $data['opis'],            
        ]);
    }
}
