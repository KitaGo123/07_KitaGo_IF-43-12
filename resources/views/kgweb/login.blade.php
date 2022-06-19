<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - Login</title>
    <link rel="stylesheet" href="{{ URL::to('/css/view.css') }}">
    <link rel="stylesheet" href="{{ URL::to('KitaGO.css') }}">
    <style>
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
        <div class="cont">
            <div class="header-left">
            Kita<span style="font-family: 'Font GO'; color:white">GO</span>
            </div>
        </div>
        <input type="hidden" name="userID" value="{{ $user = session('user'); }}">
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
    <div class="row-login">
      <div class="col-login">
        <div class= "form-L">
          <label id="package">LOGIN</label>
          <br>
          <form method="POST" action="/kgweb/logged">
          @csrf
            <div class="form-groupL" style="margin-bottom:5%; margin-top:10%">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-groupL">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <p>{{ session('msg') }}</p>
            <button class="BtnL">LOGIN</button>
          </form>
        </div>
      </div>
    </div>
    <div class="row-1">
      <div class="col">
        <h3>KitaGO will accompany your journey, anywhere and anytime. Enjoy your holiday with us</h3>
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
      <div class="col24">
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
