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
//Sluzi za rad sa oglasima
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct() {
        $this->middleware('auth');
    }
    //Prikazuje home view
    // @return view('home')
    public function index()
    {   
        //@var [Oglas] $oglasi
        $oglasi = Oglas::all();
        return view('home')->with('oglasi',$oglasi);
    }
    //Prikazuje postaviOglas view
    //@return view('postaviOglas')
     public function create()
    {
        return view('postaviOglas');
    }
    // Prikazuje prijavaZaOglas view
    //@return view('prijava za oglas')
    public function showPrijava(){
        return view('prijavaZaOglas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*Funkcija za čuvanje oglasa. U slučaju uspeha vraća poruku o uspehu i oglas ubacuje u bazu, dok u slučaju neuspeha, vraća poruku o grešci.*/
    //@param Request $request
    public function store(Request $request)
    {   
        $oglas=new Oglas;
        //@var integer $kvadratra
        $kvadratura=$request->get('kvadratura');
        if(!is_numeric($kvadratura)) return redirect()->back()->with("error","Kvadratura mora  biti broj!"); 
        if ($kvadratura<=0) return redirect()->back()->with("error","Kvadratura ne moze biti negativna!");
        //@var string $tip_prostorije
        $tip_prostorije=$request->get('tip_prostorije');
        if($tip_prostorije=='tip prostorije')
            return redirect()->back()->with("error","Izaberite tip prostorije!");
        //@var file $slika
        if($request->hasFile('slika')){
          $slika=$request->file('slika');
          //@var string $filename
          $filename=time().''.$slika->getClientOriginalExtension();
          Image::make($slika)->save(public_path('/slike/oglasi/' . $filename));
          $oglas->slika=$filename;
        }
        else return redirect()->back()->with("error","Unosenje slike je obavezno!");
        $oglas->kvadratura=$kvadratura;
        $oglas->tip_prostorije=$tip_prostorije;

        $oglas->user_id=Auth::user()->id;  
        $oglas->status="otvoren za ponude";
        $oglas->save();
        return redirect()->back()->with("success","Uspešno ste kreirali oglas!"); 
       
    }
    /*Cuvanje prijave u bazi. U slučaju uspeha vraća poruku o uspehu i prijavu čuva u bazi, u slučaj neuspeha vraća poruku o grešsci.*/
    //@param Request $requst
    //@param integer $id
    public function storePrijava(Request $request,$id){
        //@var integer $vreme
        $vreme=$request->get('vreme_izrade');
        if (!is_numeric($vreme)) return redirect()->back()->with("error","Vreme mora biti   broj!");
        //@var integer $cena
        $cena=$request->get('cena');
        if (!is_numeric($cena)) return redirect()->back()->with("error","Cena mora biti broj!");
        if ($vreme<=0) return redirect()->back()->with("error","Vreme ne moze biti negativno!");
        if ($cena<=0) return redirect()->back()->with("error","Cena ne moze biti negativna!");
        //@var Prijavljeni $prijavljen
        $prijavljen=new Prijavljeni;
        $oglas=DB::table('oglasi')->where('id',$id)->first();
        //@var integer $korisnik
        $korisnik=Auth::user()->id;
        if($oglas->user_id==$korisnik) return redirect()->back()->with("error","Ne mozete se prijaviti za sopstveni oglas");
        //@var Prijavljeni $prijavljeni
        $prijavljeni=DB::table('prijavljeni')->where('oglas_id',$oglas->id)->where('user_id',$korisnik)->first();
        if ($prijavljeni!=null) return redirect()->back()->with("error","Već ste prijavljeni za ovaj oglas!");
        else{
           
            
            $prijavljen->cena=$cena;
            $prijavljen->vreme_izrade=$vreme;
            $prijavljen->oglas_id=$id;
            $prijavljen->user_id=$korisnik;
            $prijavljen->save();
            return redirect()->back()->with("success","Uspešno ste prijavljeni za oglas!");
        }
        }
         
    /* Funkcija za prikazivanje oglasa
    @return  view('pregledajOglas').
    @param integer $id      ....Oglas->id*/
    public function showOglas($id)
    {
          

        //@var Oglas $oglas
        $oglas=Oglas::find($id);
        //@var [Oglas] $oglas
        $oglasi=Oglas::all();
        //@var [User] $user
        $users=User::all();
        //@var [Prijavljen] $prijavljeni
        $prijavljeni=DB::table('prijavljeni')->where('oglas_id',$id)->get();
        //@var integer $prikaziOdabir
        $prikaziOdabir=0;
        //var integer $pom
        $pom=Auth::user()->id;
        if($pom == $oglas->user_id) 
            $prikaziOdabir=1;

        return view('pregledajOglas')->with('id',$id)->with('prijavljeni',$prijavljeni)->with('users',$users)->with('prikazi',$prikaziOdabir);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* Ubacuje novi red u tabelu radiNa i stavlja status oglasa u "izrada"*/
    //@param Request $request
    //@return home view 
    public function update(Request $request)
    {

          $radiNa = new RadiNa;
          $diz_id=$request->get("dizajner");
          $oglas_id=$request->get("oglas");
        $radiNa->user_id = $diz_id;
        $radiNa->oglas_id = $oglas_id;
        $radiNa->save();

        $oglas = Oglas::find($oglas_id);
        $oglas->status = "izrada";
        $oglas->save();

        $oglasi = Oglas::all();
        return view('home')->with('oglasi',$oglasi);
        
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
