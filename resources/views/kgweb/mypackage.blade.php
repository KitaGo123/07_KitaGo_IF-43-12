<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - My Package</title>
    <link rel="stylesheet" href="{{ URL::to('/css/view.css') }}">
    <link rel="stylesheet" href="{{ URL::to('KitaGO.css') }}">
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
            <a href="kgweb/aboutUS">About Us</a>
            <a href="#Contact">Contact</a>
            <a href="/">Home</a> 
          </div>
        @endif
    </header>
    <div class="carde">
      <div class="carde-rigth">
        <img src="/css/user.png" alt="Avatar" style="width:40%">
        <h1 style="font-weight: bold;">{{ $user -> nama_lengkap }}</h1>
        <ul class="vpa">
          <li class="vp">
            <a href="/kgweb/{{ $user -> id }}/profile">Profile</a>
          </li>
          <li class="vp active">
            <a href="/kgweb/{{ $user -> id }}/package">My Package</a> 
          </li>
          <li class="vp">
            <a href="/kgweb/{{ $user -> id }}/editProfile">Edit Profile</a>
          </li class="vp">
          <li>
            <a href="/kgweb/logout">Logout</a>
          </li>
        </ul>
      </div>
      <div class="carde-left">
        <div class="col-12">
        <div class="my-5">
          <h3>{{ $title }}</h3>
          <hr>
        </div>
          @if (isset($package))
            @foreach ($package as $p)
              <div class="row-p">
                <div class="col-p">
                  <div class="cp">
                    <div class="rp">
                      <div class="row-pk">
                        <div class="col-pk">
                          <img src="/css/danautoba.jpg">
                        </div>
                        <div class="col-pk2">
                          <h1>{{ $p -> namaPaket }}</h1>
                          <p>price: {{ $p -> harga }}</p>
                          @foreach ($book as $b)
                            @if ($b -> idPaket == $p -> id)
                              <p style="color: #5f5d5dbd;">book date: {{ $b -> tanggalBooking }}</p>
                              <form method="POST" action="/kgweb/{{ $b -> id }}/refund" style="margin-right:250%">
                              @csrf
                                <input type="hidden" name="idBook" id="idBook" value="{{ $b -> id }}">
                                <div class="col-pk3" >
                                  <button class="Btn">Refund</button>
                                </div>
                              </form>
                            @endif
                          @endforeach
                        </div>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            @endforeach
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
