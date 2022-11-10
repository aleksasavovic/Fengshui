{{--Ivana Dragutinovic 0652/15--}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Moj profil</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114.png')}}">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome/css/font-awesome.css')}}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="{{asset('css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/nivo-lightbox/nivo-lightbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/nivo-lightbox/default.css')}}">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="{{asset('js/modernizr.custom.js')}}"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="{{route('home')}}"> Fengshui</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        @guest
        <li><a href="{{route('dizajn')}}" class="page-scroll">Dizajniraj</a></li>
        <li><a href="{{route('showGallery')}}" class="page-scroll">Galerija</a></li>
        @else 
        <li><a href="{{route('home')}}" class="page-scroll">Oglasna tabla</a></li>
        <li><a href="#page-top" class="page-scroll active">Moj profil</a></li>
        <li><a href="{{route('dizajn')}}" class="page-scroll">Dizajniraj</a></li>
        <li><a href="{{route('showGallery')}}" class="page-scroll">Galerija</a></li>
        <li class="inline-form">   
            <form method="POST" action="{{route('search')}}" >    
             @csrf     
            <input type="text" name="search" placeholder="Pretraga korisnika sajta" required>
            <button  type="submit">
             <i class="glyphicon glyphicon-search"></i>
            </button>     
            </form>            
        </li>     
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->ime }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>        
        @endguest
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>



<!------------------CONTENT------------------>

<header id="header">
  <div class="rest">
    <div class="container">
      <div class="row">
        <div class="rest-text">                   
            <main class="py-4">
              <div class="col-md-4">
                  <div class="card" >
                    <img class="card-img-top img-circle" src="/slike/users/{{$user->slika}}" alt="Slika korisnika"style="max-width: 100%;height:200px;rounded">
                    <h2 class="card-title"> {{$user->ime}} {{$user->prezime}}</h2>
                  </div>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                      
                      @if ($user->tipKorisnika == "dizajner") 
                        <h4> Prosečna ocena na sajtu:{{$user->ocena}}</h4>
                      @endif
                      <p class="card-text"> {{$user->opis}} </p>

                       <a href="#licniPodaci" class="btn btn-custom btn-lg page-scroll">Izmeni lične podatke</a> 
                       <a href="{{route('changePassForm')}}" class="btn btn-custom btn-lg page-scroll">Izmeni lozinku</a> 
                       @if ($user->tipKorisnika == "dizajner") 
                        <a href="#portfolio" class="btn btn-custom btn-lg page-scroll">Portfolio</a> 
                       @endif
                    </div>
              </div>
            </main>
          </div>
      </div>
    </div>
  </div>
</header>


<!---------------TRENUTNI OGLASI---------------->
@if ($user->tipKorisnika == "dizajner")
<div id="trenOglasi" class="text-center">
  <div class="container">

    <div class="section-title center">
      <h2>Trenutno u izradi</h2>
      <hr>
    </div>
    <div class="portfolio-items">
      <?php
        $len = count($oglasi);
        if($len>0) {
          foreach ($oglasi as $rad) { 
            if ($rad->status != "izrada") continue; ?>        
            <div class="col-sm-4 web">
              <div class="portfolio-item">
                <div class="hover-bg"> 
                  <a href="/dizajniram{{$rad->id}}">   
                    <div class="hover-text">
                      <h5>Oglas broj {{$rad->id}}</h5>
                      <h4>  Kvadratura: {{$rad->kvadratura }}  m<sup>2</sup> <br>  Prostorija: {{$rad->tip_prostorije}}</h4>
                    </div>      
                    <img src="/slike/oglasi/{{$rad->slika}}" class="img-responsive" alt="">  </div>

                  </a>

              </div>
            </div>
         <?php }
         } 
         else {?>
          </div>
          <div class="section-title center">
            <h3>{{$user->ime . " " . $user->prezime}} trenutno ne radi ni na jednom oglasu</h3>            
          </div>          
         <?php } ?>
      </div> 
  </div>
</div>
@endif



<!---------------PORTFOLIO-------------->

@if ($user->tipKorisnika == "dizajner") 
<div id="portfolio">
  <div class="container">
    <div class="section-title text-center center">
      <h2>Portfolio</h2>
      <hr>
    </div>
     <div class="portfolio-items">
      <?php
        $str = $user->radovi;
        $radovi = explode(";", $str);
        
        foreach ($radovi as $rad) { 
          if ($rad == "noimage.png") continue;?>
          <div class="col-sm-4 web">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="/slike/radovi/{{$rad}}" title="" data-lightbox-gallery="gallery1">             
                <img src="/slike/radovi/{{$rad}}" class="img-responsive" alt=""> </a> </div>
            </div>
          </div>
         <?php }?>
      </div>  
  </div>
</div>
@endif


<!--------------LICNI PODACI--------------->

<div id="licniPodaci" class="text-center">
  <div class="container">

    <div class="section-title center">
      <h2>Lični podaci</h2>
      <hr>
    </div>
    <div class="col-md-8 col-md-offset-2">
      @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
      @endif
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      @if (session('warning'))
          <div class="alert alert-warning">
              {{ session('warning') }}
          </div>
      @endif
      <form  method="POST" enctype="multipart/form-data" action="{{ route('changeInfo') }}">
        @csrf
        <div class="row">
         
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="ime" class="form-control" name="ime" value="{{ $user->ime }}" disabled>             
              <p class="help-block text-danger"></p>
            </div>
          </div>
         
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="prezime" class="form-control" name="prezime" value="{{ $user->prezime }}" disabled>         
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
       
        <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}" disabled="">             
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="tipKorisnika" class="form-control" name="tipKorisnika" value="Tip naloga: {{ $user->tipKorisnika }}" disabled="">
              <p class="help-block text-danger"></p>
            </div>
          </div>   
           
        </div>

           
        <div class="row">
           <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="opis" class="form-control{{ $errors->has('opis') ? 'is-invalid' : '' }}" placeholder="Recite nešto o sebi" name="opis" value="{{ old('opis')}}">
              <p class="help-block text-danger"></p>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="korisnicko" class="form-control{{ $errors->has('korisnicko') ? 'is-invalid' : '' }}" placeholder="Korisničko ime: {{$user->korisnicko}}" name="korisnicko" value="{{ old('korisnicko')}}" title="Za promenu korisničkog imena upišite novo ">
              <p class="help-block text-danger"></p>
            </div>
          </div>
                 
        </div>
        
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <h5>Ubacite profilnu fotografiju<input type="file" name="avatar"></h5>
          </div>
          @if ($user->tipKorisnika == "dizajner") 
           <div class="col-md-6 col-md-offset-3">
            <h5>Ubacite fotografiju za vas portfolio (možete ubaciti više slika, pojedinačno)
              <input type="file" name="rad"></h5>
          </div>
          @endif
        </div>

        <div id="success"></div>
       <!-- <button type="submit" class="btn btn-default btn-lg" onclick="oglasnaTabla.html">Uloguj se</button> -->
       <!--<a class="btn btn-default btn-lg" href="oglasnaTabla.html" role="button">Potvrdi</a>-->
        <button type="submit" class="btn btn-default btn-lg">
          {{__('Izmeni')}}
        </button>
      </form>
    </div>
  </div>
</div>


@extends('layouts.footer')


