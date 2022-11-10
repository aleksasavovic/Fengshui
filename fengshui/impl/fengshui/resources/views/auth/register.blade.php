{{--Ivana Dragutinovic 0652/15--}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spectrum</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" href="css/nivo-lightbox/default.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>

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
      <a class="navbar-brand page-scroll" href="{{route('welcome')}}"> Fengshui</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#page-top" class="page-scroll">Dizajniraj</a></li>
        <li><a href="#about" class="page-scroll">Galerija</a></li>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- Header -->
<header id="header">
  <div class="rest">
    <div class="container">
      <div class="row">
        <div class="intro-text">
          <h1> • Registruj se brzo, jednostavno i besplatno •</h1>
          <p> • Vec danas naruči profesionalno dizajniranje i uživaj u novom domu • </p>
          <a href="#logovanje" class="page-scroll"><img src="/slike/down.png" style="max-width:100%;height:90px;"></a>
        </div>
      </div>
    </div>
  </div>
</header>


<!-- Contact Section -->
<div id="logovanje" class="text-center">
  <div class="container">
    <div class="section-title center">
      <h2>Registrujte se</h2>
      <hr>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <form  method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
         
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="ime" class="form-control{{ $errors->has('ime') ? ' is-invalid' : '' }}" placeholder="Ime" name="ime" value="{{ old('ime') }}" required>
              @if ($errors->has('ime'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('ime') }}</strong>
                  </span>
              @endif
              <p class="help-block text-danger"></p>
            </div>
          </div>
         
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="prezime" class="form-control{{ $errors->has('prezime') ? ' is-invalid' : '' }}" placeholder="Prezime" name="prezime" value="{{ old('prezime') }}" required="required">
              @if ($errors->has('prezime'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('prezime') }}</strong>
                  </span>
              @endif
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
       
        <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required="required">
              @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="korisnicko" class="form-control{{ $errors->has('korisnicko') ? 'is-invalid' : '' }}" placeholder="Korisnicko ime" name="korisnicko" value="{{ old('korisnicko')}}" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div> 
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="Lozinka" name="password" required>
              @if ($errors->has('password'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
              <p class="help-block text-danger"></p>
            </div>
          </div>       
        
          <div class="col-md-6">
             <div class="form-group">
             <input type="password" id="password-confirm" class="form-control" placeholder="Potvrdite lozinku" name="password_confirmation" required>   
              </div>           
          </div>
        </div>
        
          
           
        <div class="row">
           <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="opis" class="form-control{{ $errors->has('opis') ? 'is-invalid' : '' }}" placeholder="Recite nešto o sebi" name="opis" value="{{ old('opis')}}" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div> 

          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="tipKorisnika" class="form-control{{ $errors->has('tipKorisnika') ? 'is-invalid' : '' }}" placeholder="Tip naloga: dizajner ili korisnik" title="Unesite 'dizjaner' ili 'korisnik'" name="tipKorisnika" value="{{ old('tipKorisnika')}}" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>          
        </div>

        <div id="success"></div>
       <!-- <button type="submit" class="btn btn-default btn-lg" onclick="oglasnaTabla.html">Uloguj se</button> -->
       <!--<a class="btn btn-default btn-lg" href="oglasnaTabla.html" role="button">Potvrdi</a>-->
        <button type="submit" class="btn btn-default btn-lg">
          {{__('Registrujte se')}}
        </button>
      </form>
    </div>
  </div>
</div>
<div id="footer">
  <div class="container text-center">
    <div class="fnav">
      <p>Copyright &copy; 2018 Fengshui</p>
    </div>
  </div>
</div>



<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 

<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/nivo-lightbox.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 

<script type="text/javascript" src="js/main.js"></script>

</body>
</html>