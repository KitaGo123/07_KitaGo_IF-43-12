<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO</title>
    <link rel="stylesheet" href="{{ URL::to('/css/view.css') }}">
    <link rel="stylesheet" href="{{ URL::to('KitaGO.css') }}">
	  <link rel="stylesheet" type="text/css" href="responsived.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
      html {
        scroll-behavior: smooth;
      }
      @font-face {
        font-family: "Font GO";
        src: url('Backsteal-Regular.OTF');
      }
	  
	    @font-face {
        font-family: "Font chiken";
        src: url('Organic Relief.TTF');
      }
    </style>
</head>
  <body>
  <header>
        <input type="hidden" name="userID" value="{{ $user = session('user'); }}">
        <input type="hidden" name="paketID" value="{{ $paket = session('paket'); }}">
        <input type="hidden" name="rateID" value="{{ $rates = session('rates'); }}">
        <div class="cont">
            <div class="header-left">
            Kita<span style="font-family: 'Font GO'; color:white">GO</span>
            </div>
        </div>
        @if (isset($user))
          <div class="navbar">
            <div class="dropdown">
                      <img class="imgbtn" src="/css/profile-user.png" style="margin-right: 50px">
              <div class="dropdown-content">
                <a href="/kgweb/{{$user -> id}}/profile">View Profile</a>
                <a href="/kgweb/{{$user -> id}}/editProfile">Edit Profile</a>
                <a href="/kgweb/logout">Log Out</a>
              </div>
            </div> 
            <a href="/kgweb/aboutUS">About Us</a>
            <a href="#Contact">Contact</a>
            <a href="/">Home</a> 
          </div>
        @else
          <div class="navbar">
            <div class="dropdown">
              <button class="dropbtn">Sign Up</button>
              <div class="dropdown-content">
                <a href="/kgweb/regis/agent">Agent Traveller</a>
                <a href="/kgweb/regis/customer">Traveller</a>
              </div>
            </div> 
            <a href="/kgweb/login">Login</a>
            <a href="/kgweb/aboutUS">About Us</a>
            <a href="#Contact">Contact</a>
            <a href="/">Home</a> 
          </div>
        @endif
    </header>
    <section>
    
    <div class="search" style="padding-top:10%; font-size:18px">
      <input type="text" id="search" placeholder="Search Nama Paket..." name="search">
      <button onclick="search()" style="cursor: pointer;"><i class="fa fa-search"></i></button>
    </div>
    <script>
      function search(){
        const scroll = document.getElementById('search').value;
        const e = document.getElementById(scroll);
        if (e !== null) {
          e.scrollIntoView({block: "center"});
        } else {
          alert("Package Not Found");
        }
        
      }
    </script>
		<div class="container">
			<div class="scrollmenu">
				@if (isset($paket))
          @if (isset($user -> nama_lengkap))
            <div class="promotion" style="padding-top:30px">
              <h2>Choose Your Destination Package</h2>
            </div>
            @foreach ($paket as $p)
              <div class="cardL" id="{{$p -> namaPaket}}" value="{{$p -> namaPaket}}">
                <div class="contentL">
                  <h3>{{ $p -> namaPaket}}</h3>
                  <p>{{$p -> deskripsi}}</p>
                  @if (isset($rates))
                    <div class="imgBxL">
                      <p>
                        <?php
                          if (isset($rates)) {
                            $value = 0;
                            $count = 0;
                            floatval ($value);
                            floatval ($count);
                            foreach ($rates as $r) {
                              if ($r -> idPaket == $p -> id) {
                                $value += $r -> rating;
                                $count += 1;
                              }
                            }
                            if ($count != 0) {
                              $value *= 10;
                              echo number_format($value / $count / 10, 1);
                            } else {
                              echo 0;
                            }
                          }
                        ?>
                      </p>
                      
                    </div>
                  @endif
                </div>
                <div class="sciL">
                  <a class="btn btn-danger" href="/kgweb/paket/{{$p -> id}}/viewPaket">Details...</a>
                </div>
              </div>
            @endforeach
          @endif
        @endif  
			</div>
		</div> 
	  </section>
  
  </body>
  <div class="row-1">
      <div class="col">
        <h3>KitaGO will accompany your journey, anywhere and anytime</h3>
        <button><a href="#package" style="color:black">Chek our catalog package</a></button>
      </div>
      <div class="col-2">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=bandung&ie=UTF8&t=&z=14&iwloc=B&output=embed" style="filter: contrast(1.2) opacity(3);height: 100%;"></iframe>
      </div>
    </div>
    <div class="row-2">
      <div class="col1">
        <div class="logof">
          Kita<span style="font-family: 'Font GO'; color:#1e90ff">GO</span>
          <p>Make your holiday be filled with joyness!</p>
        </div>
      </div>
      <div class="col22">
        <h1>Features</h1>
        <ul>
          <li><a href="/kgweb/login">Login</a></li>
          <li><a href="/kgweb/aboutUS">About Us</a></li>
          <li><a href="#Contact">Contact</a></li>
          <li><a href="/kgweb">Home</a></li>
        </ul>
      </div>
      <div class="col23" id="Contact">
        <h1>Contact Us</h1>
        <p>Jl. Telekomunikasi No. 1,</p>
        <p>Terusan Buahbatu - Bojongsoang, Sukapura,</p>
        <p>Kecamtan Dayeuhkolot, Kabupaten Bandung,</p>
        <p>Jawa Barat 40257</p>
      </div>
      <div class="col24" id="About">
        <p>This website present by</p>
        <p>Telkom University Group 9</p>
        <img src="/css/telkom.png">
      </div>
    </div>
  </body>
  <footer>
    <hr style="margin-left: 20px;margin-right: 20px;color:#333">
    <ul>
      <li>&copy 2022 KitaGO Company, Inc</li>
      <li><img src="/css/twitter.png" style="width:27px"></li>
      <li><img src="/css/instagram.png" style="width:27px"></li>
      <li><img src="/css/facebook.png" style="width:27px"></li>
    </ul>
  </footer>
</html>
