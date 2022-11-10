<?php
//Ivana Dragutinović 0652/2015
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;  
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Oglas;
use DB;
use Image;

//Kontroler za vraćanje pregleda profila i izmene na profilu korisnika

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }



    /*  vraca licni profil korisnika
    *   $oglasi - niz oglasa na kojima radi vlasnik profila 
    *   @return view('profile.myProfile')
    */
    public function index()         
    {
        if (Auth::check()){
            $user = Auth::user();
        }
        //$oglasiRad = DB::table('radi_na')->where('user_id', $user->id)->get();
        $oglasi = DB::select(DB::raw("SELECT * FROM Oglasi o, radi_na r
                                    WHERE r.user_id=$user->id AND
                                          o.id = r.oglas_id"));      

        return view('profiles.myProfile')->with('user', $user)->with('oglasi', $oglasi);
    }

   
    /**
     *  Upisuje zeljene podatke u bazu
     *  
     *  @param  \Illuminate\Http\Request  $request
     *  @return view('profile.myProfile')
     */
    public function store(Request $request)         
    {
      

        $opis = $request->get('opis');
        $korisnicko = $request->get('korisnicko');
        $rad=null;
        $avatar=null;
        

        //Change data
        $user=Auth::user();
        

        if ($opis != "")            //ako menja opis
            $user->opis = $request->get('opis');
        if($korisnicko != "") {         //ako menja korisnicko
            $user->korisnicko = $request->get('korisnicko');
        }
        if ($request->hasFile('avatar')) {              //ako menja profilnu sliku
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/slike/users/' . $filename));
            $user->slika = $filename;
        }
        if ($request->hasFile('rad')) {              //ako je dodao sliku za svoj portfolio
            $rad = $request->file('rad');
            $radIme = time() . '.' . $rad->getClientOriginalExtension();
            Image::make($rad)->save(public_path('/slike/radovi/' . $radIme));
            $preth = $user->radovi;   
            $user->radovi = $preth . ';' . $radIme;
        }
        if ($opis==null && $korisnicko==null && $rad==null && $avatar==null)
            return redirect()->back()->with("warning","Niste uneli podatke za promenu. Molimo Vas, pokušajte ponovo!");

        $user->save();
    
        return redirect()->back()->with("success","Uspešno ste promenili željene podatke!");
    }

     /**
     *  Promena lozinke korisnika
     *  
     *  @param  \Illuminate\Http\Request  $request
     *  @return view('profile.myProfile')
     */
    public function changePassword(request $request) {      
         if (!(Hash::check($request->get('curPassword'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Vaša trenutna šifra ne odgovara onome što ste uneli. Molimo Vas, pokušajte ponovo.");
        }
 
        if(strcmp($request->get('curPassword'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Nova šifra ne može biti ista kao prethodna. Molimo Vas, pokušajte ponovo. ");
        }
        
 
        $data = $this->validate(request(),[
            'curPassword' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user=Auth::user();
        $user->password = bcrypt($data['password']);
        $user->save();

        $oglasi = DB::select(DB::raw("SELECT * FROM Oglasi o, radi_na r
                                      WHERE r.user_id=$user->id AND
                                            o.id = r.oglas_id"));
 
        return view('profiles.myProfile')->with('user', $user)->with('oglasi', $oglasi);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return view('profile.myProfile')
     */
    public function show($id)       //vraca profil nekog korisnika koji ulogovani korisnik zeli da poseti
    {
        $user = DB::table('users')->where('id', $id)->first();      //vraca kolonu
        $ulogovani = Auth::user();

        if ($user->id == $ulogovani->id) {
            $oglasi = DB::select(DB::raw("SELECT * FROM Oglasi o, radi_na r
                                    WHERE r.user_id=$user->id AND
                                          o.id = r.oglas_id"));
            return view('profiles.myProfile')->with('user', $user)->with('oglasi', $oglasi);
        }
        else
            return view('profiles.yourProfile')->with('user', $user) ;
    }


    /**
     *Ocenjivanje dizajnera 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return view('profile.yourProfile')
     */
    public function update(Request $request, $id)    
    {
        $ocena = $request->get('ocena');        

        if ($ocena == 1 || $ocena==2 || $ocena==3 || $ocena==4 || $ocena == 5) {    //ako je ceo broj

            $ocenjivan = User::find($id);
            $user=Auth::user(); //onaj koji ocenjuje tj ulogovani korisnik

            $oglasi = Oglas::where('user_id', $user->id)->get();    
            $nadjen = null;
            $ret=null;
            foreach($oglasi as $oglas) {
                $ret = DB::table('radi_na')->where('oglas_id', $oglas->id)->where('user_id', $ocenjivan->id)->first();            
                if ($ret != null) {
                    $nadjen = $oglas;
                    break;
                }
            }

            if ($ret == null ) {            
                return redirect()->back()->with("error","Ne možete oceniti dizajnera ukoliko niste sarađivali sa njim.");
            }     
            if ($ocena<1 || $ocena>5) {            
                return redirect()->back()->with("error","Ocena koju ste uneli nije u rangu od 1 do 5. Molimo Vas, pokušajte ponovo.");
            }    
            if ($nadjen!= null && $nadjen->status!="zavrsen") {            
                return redirect()->back()->with("error","Ne možete oceniti dizajnera dok Vaš rad ne bude završen.");
            }

            $suma = $ocenjivan->sumaOcena;
            $ocenilo =  $ocenjivan->ocenilo;
            $ocenjivan->sumaOcena = $suma + $ocena;
            $ocenjivan->ocenilo = $ocenilo + 1;
            $ocenjivan->ocena = $ocenjivan->sumaOcena / $ocenjivan->ocenilo;
            $ocenjivan->save();

            return redirect()->back()->with("success","Uspešno ste ocenili dizajnera!");
        }
        else {
            return redirect()->back()->with("error","Ocena mora biti ceo broj u rangu od 1 do 5. Molimo Vas, pokušajte ponovo.");
        }
    }


}
