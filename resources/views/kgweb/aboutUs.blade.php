<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - About Us</title>
    <link rel="stylesheet" href="{{ URL::to('KitaGO.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/view.css') }}">
    
	  <link rel="stylesheet" type="text/css" href="responsived.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
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

    <div class="top-about">  
    <h1 style="font-family: 'Font GO'; color:#1e90ff">About Us</h1>
    <div class="paragraf"> 
    <p style="font-family: 'Font Kita'color: black">Aplikasi KitaGO ini berbasis website dimana hanya akan menampilkan destinasi wisata yang ada di Jawa Barat. Aplikasi ini dibuat dengan latar belakang banyaknya tempat wisata dan penginapan yang ada di Jawa Barat, kami ingin memudahkan turis lokal maupun internasional mengeksplor wisata di Jawa Barat, dan melihat potensi bidang pariwisata yang akan maju seiring dengan berkembangnya dunia digital. KitaGO memiliki kelebihan tersendiri dari aplikasi lainnya, yaitu KitaGO menyediakan paket perjalanan dimana didalamnya sudah ada destinasi wisata dan penginapan dengan harga yang lebih terjangkau dibandingkan melakukan perjalanan tanpa paket. Dengan adanya paket juga memudahkan traveller untuk melakukan perjalanan terutama ketempat yang baru mereka kunjungi. </p>
    </div>
    <h2 style="font-family: 'Font GO'; color:orange;margin-top:60px">Team KitaGo</h2>
    <div class="container">
        <div class="about">
          <img src="/css/Ridho.jpg">
          <span>Ridho Israll Essa</span>
          <p></p>
          <span>1301194191</span>
          <p></p>
          <span>IF 43 12</span>
        </div>
        <div class="about">
          <img src="/css/Dita.jpg">
          <span>Dita Noviyanti</span>
          <p></p>
          <span>1301194125</span>
          <p></p>
          <span>IF 43 12</span>
        </div> 
        </div>
        <div class="container"> 
        <div class="about">
          <img src="/css/Irkham.jpg">
          <span>Irkham Muhammad Fakhri</span>
          <p></p>
          <span>1301190291</span>
          <p></p>
          <span>IF 43 12</span>
        </div>
        <div class="about">
          <img src="/css/Gharyni.jpg">
          <span>Gharyni Nurkhair Mulyono</span>
          <p></p>
          <span>1301194319</span>
          <p></p>
          <span>IF 43 12</span>
        </div> 
        </div>
    </div>
  </body>
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