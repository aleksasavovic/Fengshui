{{--Aleksa Savović 0387/15
--}}
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
        <li><a href="{{route('myProfile')}}" class="page-scroll ">Moj profil</a></li>
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

<!-- Header -->
<header id="header">
  <div class="rest">
    <div class="container">
      <div class="row">
        <div class="rest-text">
          <div class="section-title center">
             <h4 class="card-title">Postavi oglas</h2>
                <hr>
              </div>
            </h4>
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
                <form  method="POST" enctype="multipart/form-data" action="{{ route('postaviOglas') }}">
                  @csrf
             <div class="form-group">

              <select class="form-control" id="tip_prostorije" name="tip_prostorije">
                <option>tip prostorije</option>
                <option>dnevna soba</option>
                <option>trepezarija</option>
                <option>spavaća soba</option>
                <option>kupatilo</option>
                <option>kuhinja</option>
                <option>ceo stan</option>
              </select>
              </div>
              <div class="form-group">
              <input type="text" class="form-control" id="kvadratura" name="kvadratura" placeholder="Kvadratura prostorije (ceo broj)" value="" required="required">
              </div>
             
              
            
              
              <div class="form-group">
              <h1><b><label for="exampleFormControlFile1 #414a52;"><font color="white";>Dodajte sliku prostora</font></label></b></h1><br>
              <input type="file" class="form-control-file tn btn-default btn-lg" id='slika' name='slika' >
              </div>

             <button type="submit" class="btn btn-default btn-lg">Postavi Oglas</button>            

            </form>
            <br><br>
         </div>
        </div>
      </div>
    </div>

  </div>
</header>




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