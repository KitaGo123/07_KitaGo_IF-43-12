<!DOCTYPE html>
<!--PENDAHULUAN-->
<!--Source code berikut adalah view dari tampilan LOGIN. Didalamnya terdapat header, body (form), dan footer-->
<!--Header terdiri dari logo dan navigasi bar-->
<!--Body terdapat form untuk melakukan proses login, seperti input username dan password-->
<!--Footer terdapat logo dan beberapa navigasi serta informasi map dan Telkom Univeristy-->
<html>
<head>
    <!--Definisi seluruh library yang dibutuhkan-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - Login</title>
    <link rel="stylesheet" href="{{ URL::to('/css/view.css') }}">
    <link rel="stylesheet" href="{{ URL::to('KitaGO.css') }}">
    <!--mendefinisikan style untuk font-->
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
        <!--Header-->
        <div class="cont">
            <!--pembuatan logo-->
            <div class="header-left">
            Kita<span style="font-family: 'Font GO'; color:white">GO</span>
            </div>
        </div>
        <!--mengambil data user pada session-->
        <input type="hidden" name="userID" value="{{ $user = session('user'); }}">
        <!--navigasi bar plus metode dropdown pada logo profile-->
        <!--navbar apabila user telah login-->
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
        <!--navbar apabila user belum login-->   
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
    <!--Body-->
    <div class="row-login">
      <div class="col-login">
        <div class= "form-L">
          <label id="package">LOGIN</label>
          <br>
          <!--FORM LOGIN
          * Form ini digunakan untuk melakukan login, dimana terdapat username dan password yang harus diinputkan oleh user
            Ketika user selesai menginputkan username dan password pada hal tersebut akan dikirim oleh controller dan dichek
            (validasi) apakah data yang dimasukan telah benar. Jika data yang dimasukan salah maka akan muncul notifikasi
            yang telah diatur juga oleh controller-->
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
    <!--FOOTER-->
    <div class="row-1">
      <div class="col">
        <h3>KitaGO will accompany your journey, anywhere and anytime. Enjoy your holiday with us</h3>
      </div>
      <!--API Map untuk daerah bandung-->
      <div class="col-2">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=bandung&ie=UTF8&t=&z=14&iwloc=B&output=embed" style="filter: contrast(1.2) opacity(3);height: 100%;"></iframe>
      </div>
    </div>
    <div class="row-2">
      <div class="col1">
        <!--Logo-->
        <div class="logof">
          Kita<span style="font-family: 'Font GO'; color:#1e90ff">GO</span>
          <p>Make your holiday be filled with joyness!</p>
        </div>
      </div>
      <!--Navbar Footer-->
      <div class="col22">
        <h1>Features</h1>
        <ul>
          <li><a href="/kgweb/login">Login</a></li>
          <li><a href="/kgweb/aboutUS">About Us</a></li>
          <li><a href="#Contact">Contact</a></li>
          <li><a href="/kgweb">Home</a></li>
        </ul>
      </div>
      <!--Alamat Kantor-->
      <div class="col23" id="Contact">
        <h1>Contact Us</h1>
        <p>Jl. Telekomunikasi No. 1,</p>
        <p>Terusan Buahbatu - Bojongsoang, Sukapura,</p>
        <p>Kecamtan Dayeuhkolot, Kabupaten Bandung,</p>
        <p>Jawa Barat 40257</p>
      </div>
      <!--Telkom University-->
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
