<?php
//Ilija Stevanović 0652/2015
namespace App\Http\Controllers;

//header('Access-Control-Allow-Origin: *');

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

class UnityController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()         //otvara unity app
    {
        Session::put('trebaEmail', 'false');
        return view('dizajniranje');
    }


    public function dizajnerRadi($id)         //otvara unity app
    {
        Session::put('idO', $id);
        Session::put('trebaEmail', 'true');
        return view('dizajniranje');
    }

    public function sendEmail(Request $request)         //salje email 
    {

        $user=Auth::user();

        $radIme = '';
        if ($request->hasFile('fileUpload')) {              

            $rad = $request->file('fileUpload');

            $radIme = time() . '.png';
            //Image::make($rad)->save(public_path('/slike/radovi/' . $radIme));
            $rad->move(public_path('/slike/radovi/'), $radIme);
            $preth = $user->radovi;   
            $user->radovi = $preth . ';' . $radIme;
            $user->save();
        }

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
        $email->setFrom('ludosveto@gmail.com', 'FengShui');
        $email->Subject   = 'FengShui - Vaš oglas';

        if(Session::get('trebaEmail') == 'true')
            $email->Body      = file_get_contents(public_path('mail/emailContent.html'));
        else $email->Body     = file_get_contents(public_path('mail/selfEmailContent.html'));

        $email->IsHTML(true);

        //$email->AddAddress( 'ilijaste96@gmail.com' );

        /*$oglas = DB::table('oglasi')->where('id', Session::get('idO'))->first();
        $uemail = DB::table('users')->where('id', $oglas->user_id)->value('email');*/
        

        if(Session::get('trebaEmail') == 'true'){

            $oglas = Oglas::find(Session::get('idO'));
            $klijent = User::find($oglas->user_id);
            $email->AddAddress($klijent->email);
            $oglas->status = "zavrsen";
            $oglas->save();

        }else{
            $email->AddAddress($user->email);
        }

        if($request->hasFile('fileUpload')){

            $email->AddAttachment(public_path('/slike/radovi/').$radIme , 'capture.png');
        }

        $email->send();

        return view('dizajniraje');
    }
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */

  
}
