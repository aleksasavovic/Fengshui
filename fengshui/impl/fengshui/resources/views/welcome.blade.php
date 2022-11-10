{{--Ivana Dragutinovic 0652/15--}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fengshui</title>
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
        @guest
        <li><a href="{{route('dizajn')}}" class="page-scroll">Dizajniraj</a></li>
        <li><a href="{{route('showGallery')}}" class="page-scroll">Galerija</a></li>
        @else 
        <li><a href="#" class="page-scroll">Dizajniraj</a></li>
        <li><a href="#" class="page-scroll">Galerija</a></li>
        @endguest
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- Header -->
<header id="header">
  <div class="intro">
    <div class="container">
      <div class="row">
        <div class="intro-text">
          <h1>Fengshui</h1>
          <p> • Dizajniraj dom iz snova • </p>
          <a href="#logovanje" class="btn btn-custom btn-lg page-scroll">Uloguj se</a> 
          <a href="{{ route('register') }}" class="btn btn-custom btn-lg">Registruj se</a> 
        </div>
      </div>
    </div>
  </div>
</header>


<!-- Contact Section -->
<div id="logovanje" class="text-center">
  <div class="container">
    <div class="section-title center">
      <h2>Ulogujte se</h2>
      <hr>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <form name="logForma" id="logovanjeForm" method="POST"  action="{{ route('login') }}">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
              <p class="help-block text-danger"></p>
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="Lozinka" required>
              <p class="help-block text-danger"></p>
            </div>
            @if ($errors->has('password'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>          
        </div>
        <div id="success"></div>
       <!-- <button type="submit" class="btn btn-default btn-lg" onclick="oglasnaTabla.html">Uloguj se</button> -->
      <!-- <input class="btn btn-default btn-lg" href="oglasnaTabla.html" role="button">Uloguj se</a><br><br>-->
      <button type="submit" class="btn btn-default btn-lg">
          {{ __('Ulogujte se') }}
      </button><br><br>
       
      </form>
      <!--<a href="{{ route('password.request') }}"> Zaboravili ste šifru? </a>-->
      <form method="GET" >
        <a href="{{ route('obnova') }}"> Zaboravili ste šifru? </a>
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