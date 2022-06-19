<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - Register Agent</title>
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
      .form-groupP label{
        font-size:10px;
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
    <div class="row-login" style="padding-top:7%;padding-bottom:30px">
      <div class="col-login">
        <div class= "form-L">
          <label id="package" style="margin-right:30%;">Register</label>
          <br>
          @if ($type == 'agent')
            <form method="POST" action="/{{$action }}">
            @csrf
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Nama Penyedia Jasa</label><br>
                <input type="text" class="form-control" name="nama_penyedia_jasa" id="nama_penyedia_jasa" placeholder="Masukkan Nama Agen" value="{{isset($data)?$data->nama_lengkap:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Email</label><br>
                <input type="email" class="form-control" name="emailP" id="emailP" placeholder="Masukkan Email" value="{{isset($data)?$data->emailP:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Alamat</label><br>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat Kantor" value="{{isset($data)?$data->alamat:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Telphone Number</label><br>
                <input type="tel" class="form-control" name="telpNumbP" id="telpNumbP" placeholder="Masukkan Nomor" value="{{isset($data)?$data->telpNumbP:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Username</label><br>
                <input type="text" class="form-control" name="usernameP" id="usernameP" placeholder="Masukkan Username" value="{{isset($data)?$data->usernameP:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Password</label><br>
                <input type="password" class="form-control" name="passwordP" id="passwordP" placeholder="Masukkan Password" value="{{isset($data)?$data->passwordP:'' }}">
              </div>
              <div>
                <input type="hidden" name="type" value="agent">
              </div>
              <p style="text-align:left;margin-bottom:5%; margin-top:10%;">{{ session('msg') }}</p>
              <button class="BtnL" style="margin-right:30%">REGISTER</button>
            </form>
          @elseif ($type == 'customer')
          <form method="POST" action="/{{$action }}">
            @csrf
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Nama Lengkap</label><br>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="{{isset($data)?$data->nama_lengkap:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Email</label><br>
                <input type="email" class="form-control" name="emailC" id="emailC" placeholder="Masukkan Email" value="{{isset($data)?$data->emailC:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Birth Date</label><br>
                <input type="date" class="form-control" name="birthDate" id="birthDate" value="{{isset($data)?$data->birthDate:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Telphone Number</label><br>
                <input type="tel" class="form-control" name="telpNumbC" id="telpNumbC" placeholder="Masukkan Nomor" value="{{isset($data)?$data->telpNumb:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Username</label><br>
                <input type="text" class="form-control" name="usernameC" id="usernameC" placeholder="Masukkan Username" value="{{isset($data)?$data->usernameC:'' }}">
              </div>
              <div class="form-groupP" style="text-align:left;margin-bottom:5%; margin-top:10%;">
                <label style="font-size:18px;">Password</label><br>
                <input type="password" class="form-control" name="passwordC" id="passwordC" placeholder="Masukkan Password" value="{{isset($data)?$data->passwordC:'' }}">
              </div>
              <div>
                <input type="hidden" name="type" value="customer">
              </div>
              <p style="text-align:left;margin-bottom:5%; margin-top:10%;">{{ session('msg') }}</p>
              <button class="BtnL" style="margin-right:30%">REGISTER</button>
            </form>
          @endif
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
        <p>Telkom University Group 6</p>
        <img src="/css/telkom.png">
      </div>
    </div>  
  </body>
  <footer>
    <hr style="margin-left: 20px;margin-right: 20px;color:#333">
    <ul>
      <li>&copy 2022 KitaGO Company, Inc</li>
      <li><a href="https://twitter.com/login"><img src="twitter.png" style="width:27px"></a></li>
      <li><a href="https://www.instagram.com/"><img src="instagram.png" style="width:27px"></a></li>
      <li><a href="https://web.facebook.com/"><img src="facebook.png" style="width:27px"></a></li>
    </ul>
  </footer>
  
</html>
