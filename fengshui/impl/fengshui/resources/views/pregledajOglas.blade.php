{{--Aleksa Savović 0387/15
--}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pregled oglasa</title>
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
            <div class="col-md-8 col-md-offset-2">
              @if(Auth::user()->tipKorisnika=="dizajner")
          
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
                <div class="section-title center">
                  <h2 style="color:white";>Zainteresovani ste za izradu ovog oglasa? Prijavite se!</h2>
                </div>
                <div>
                <form  method="POST" enctype="multipart/form-data" action="{{ route('pregledajOglas',$id) }}">
                  @csrf
           
                  <div class="form-group">
                  <input type="text" class="form-control" id="vreme_izrade" name="vreme_izrade" placeholder="Vreme  potrebno za izradu (ceo broj u danima)" value="" required="required">
                  </div>
                  <div class="form-group">
                  <input type="text" class="form-control" id="cena" name="cena" placeholder="Cena dizajniranja" value="" required="required">
                  </div>              
                
                  <div>   
              
                  <button type="submit" class="btn btn-default btn-lg" >Prijavi se!</button>
                  </div>
                </form>
                 <hr>
                @endif         
                </div>


          <div class="section-title center">           
          <h4 class="card-title"> • Prijavljeni Dizajneri  za oglas br {{$id}}• </h4>
          </div>                  
            
             @if (count($prijavljeni)>0) 

              @foreach($prijavljeni as $prijavljen) 

                <div class="row">

                  <div class="col-md-4">
                      <div class="card">
                        @foreach($users as $user)
                           @if($user->id==$prijavljen->user_id)
                             @break
                           @endif
                        @endforeach
                        <a href="/profiles/{{$prijavljen->user_id}}"><img class="card-img-top img-circle" src="/slike/users/{{$user->slika}}" alt="Slika korisnika"style="max-width: 100%;height:200px;rounded"></a>

                        <h2 class="card-title"> {{$user->ime}} {{$user->prezime}}</h2>
                      </div>
                  </div
                  >
                  <div class="col-md-8">
                    <div class="card-body">                      
                          
                          <h4> Prosečna ocena na sajtu:{{$user->ocena}}</h4>
                          <p class="card-text">Cena dizajniranja: {{$prijavljen->cena}}eura<br> Vreme izrade:{{$prijavljen->vreme_izrade}}dana
                          @if($prikazi==1)
                          <br>
                        <form  method="POST" enctype="multipart/form-data" action="{{ route('izaberi') }}">
                          <input type="hidden" id="oglas" name="oglas" value= {{$prijavljen->oglas_id}} >
                          <input type="hidden" id="dizajner" name="dizajner" value={{$prijavljen->user_id}}>
                            <button type="submit" class="btn btn-default " >Izaberi</button>
                            @csrf
                          </form> 
                          @endif() </p>

                        </div>
                  </div>

                </div>                           
                
             @endforeach
              
            @else
               <h4 class="card-title"> • Za sada nema prijavljenih  • </h4>
            @endif
</div>
</div>
</div>
</div>
</div>
</header>




<div id="footer">
  <div class="container text-center">
    <div class="fnav">
      <p>Copyright &copy;  2018 Fengshui</p>
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