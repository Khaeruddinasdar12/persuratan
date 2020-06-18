<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>papan infromasi digital | KeDai Computerworks</title>

  
  <link href="{{ asset('papaninfo/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('papaninfo/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('papaninfo/css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('papaninfo/css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('papaninfo/css/owl.theme.default.min.css') }}" rel="stylesheet">
  <script src="{{ asset('papaninfo/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('papaninfo/js/wow.js') }}"></script>
  <script src="{{ asset('papaninfo/js/owl.carousel.js') }}"></script>
</head>

<body>
  <div class="container">
    <nav class="navbar">
      <a class="navbar-brand " href="#">
        <img alt="Brand" src="{{ asset('papaninfo/img/logoKDCW.png') }}" class="brand">
      </a>
      <span class="navbar-text">
        <img src="{{asset('papaninfo/img/header-logo2.png') }}" class="logo">
      </span>
    </nav>

    <div class="row">
      <div class="col-md-5">
        <div class="owl-carousel owl-theme">
          @foreach($foto as $fotos)
          <div class="item galery">
            <img src="storage/{{$fotos->content}}">
          </div>
          @endforeach
        </div>
        <center><h4 class="data-perpustakaan">Data Perpustakaan :</h4> </center>
        <div class="owl-carousel owl-theme">
          @foreach($perpus as $books)
          <div class="item">
            <center><h6>{{$books->judul}}</h6>
            <small>{{$books->konsentrasi}}</small></center>
          </div>
          @endforeach
        </div>
        <center><h4 class="agenda">Kegiatan yang akan datang :</h4></center>
        <div class="wow infinite bounce pin" data-wow-duration="2s">
          @foreach($event as $events)
          <center><p>{{$events->content}}</p></center>
          @endforeach
        </div>
      </div>

      <div class="col-md-5">
        <iframe width="635" height="510" frameborder="0" allowfullscreen="1" allow="autoplay"
        src="https://www.youtube.com/embed/playlist?list=UUp0sX1OsrnxKYjYjVQuvA4w&autoplay=1&controls=0">
      </iframe>
    </div>

  </div>



  <footer>
    <div class="row">
      <div class="col-md-6">
        <div class="pull-right">
          Papan Informasi Digital - KeDai Computerworks
        </div>
      </div>
      <div class="col-md-6">
        <div class="jam-digital">
          <div class="kotak">
            <p id="jam"></p>
          </div>
          <div class="kotak">
            <p id="menit"></p>
          </div>
          <div class="kotak">
            <p id="detik"></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>













<!-- Bootstrap -->
<script src="{{ asset('papaninfo/js/bootstrap.min.js') }}"></script>
<script>
  window.setTimeout("waktu()", 1000);

  function waktu() {
    var waktu = new Date();
    setTimeout("waktu()", 1000);
    document.getElementById("jam").innerHTML = waktu.getHours();
    document.getElementById("menit").innerHTML = waktu.getMinutes();
    document.getElementById("detik").innerHTML = waktu.getSeconds();
  }
</script>
<script>
  $('.owl-carousel').owlCarousel({
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    loop:true,
    margin: 10,
    autoHeight: false,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  });
</script>
</body>

</html>