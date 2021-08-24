<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coming Soon</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('landing_asset/css/unavailable.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <span class="bar"><i class="fa fa-bars"></i></span>
  <nav class="toggle-nav">
    <ul class="listing">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href="#">
            <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li>
            <a href="#">
            <i class="fa fa-instagram"></i>
            </a>
        </li>
        <li>
            <a href="mailto:#">
            <i class="fa fa-envelope"></i>
            </a>
        </li>
    </ul>
  </nav>
  <section class="coming-soon">
    <div class="coming-soon-inner">
      <h1 class="heading">Coming Soon</h1>
      <h2 class="small-heading">Under Construction</h2>
      <div class="counter-timer">
        <ul>
            <li><span id="days"></span>days</li>
            <li><span id="hours"></span>Hours</li>
            <li><span id="minutes"></span>Minutes</li>
            <li><span id="seconds"></span>Seconds</li>
          </ul>
        </div>
    </div>
  </section>
  <!-- loader -->
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>

  <script src="{{ asset('landing_asset/js/unavailable.js') }}"></script>
  <script>
    $(window).on("load",function(){
      $(".loader-wrapper").fadeOut("slow");
    });
  </script>
</body>
</html>