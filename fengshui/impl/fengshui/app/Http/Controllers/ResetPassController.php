<?php
//Ivana Dragutinović 0652/2015
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Oglas;
use DB;
use Image;
use Session;



//Kontroler koji salje email sa novom loznikom ako je trenutka zaboravljena.

class ResetPassController extends Controller
{

	/*
	funkcija za slanje email-a sa novom lonizkom
	string $mejl 
	string $nova
	PhpMAiler $email

	return view('obnova');
	*/
    public function posalji(Request $request) {        //salje mejl za obnovu sifre
        $mejl = $request->get('email');
        $nova = time();
        $email = new PHPMailer();
        $email->isSMTP();
        $email->SMTPDebug = 2;
        $email->Debugoutput = 'html';
        $email->Host = 'smtp.gmail.com';
        $email->Port = 587;
        $email->SMTPSecure = 'tls';
        $email->SMTPAuth = true;
        $email->Username = "ludosveto@gmail.com";
        $email->Password = 'sifra123';
        $email->setFrom('ludosveto@gmail.com', 'FengShui ');
        $email->Subject   = 'Obnova lozinke';
        $email->Body  = "Poštovani, \n\nDobili smo zahtev za obnovu Vaše lozinke. Vaša nova pristupna lozinka je: " . $nova . ".\n\nHvala što koristite naše usluge, \nFengShui";
        
        $email->AddAddress( $mejl );
        $email->send();

        User::where('email', $mejl)->update(['password' =>  bcrypt($nova)]);
        
        return redirect()->back()->with("success","Uspešno ste poslali email!");
    }



    /* funkcija koaj otvara formu za unos emaila na koji se salje nova sifra
    @retrun view('obnova')*/
    public function obnova() {
        return view('obnova');
    }
}
