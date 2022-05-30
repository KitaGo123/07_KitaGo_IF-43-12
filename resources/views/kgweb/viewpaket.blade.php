<!DOCTYPE html>
<!--
 * PENDAHULUAN

 * Tujuan : Codingan ini bertujuan untuk dapat melihat data dari paket yang dipilih oleh user.

 * Deskripsi : Codingan ini merupakan view untuk menampilkan data paket secara lebih detail.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - View Paket</title>
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
      span{
        margin-left:36%;
        text-align:center;
        font-family: arial;
        font-size:20px;
        font-weight: bold;
        color:blue;
      }
    </style>
</head>
  <body>
    <header>
        <!--Header-->
        <div class="cont">
            <div class="header-left">
            Kita<span style="font-family: 'Font GO'; color:white;margin-left:0%;font-size:50px">GO</span>
            </div>
        </div>
        <input type="hidden" name="userID" value="{{ $user = session('user'); }}">
        <!--Mengambil data user dari session-->
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
    <div class="top-view">
      <!--Data paket diterima oleh controller paket-->
      <div class="contain">
      <h2>{{ $paket -> namaPaket }}</h2>
      <p style="text-align:center;font-size:21px">Price: Rp {{ $paket -> harga }}</p>
      <form name="rateForm" method="POST" action="/kgweb/{{ $paket -> id }}/rate" style="margin-left:35%"><br>
        <!--
          * Form untuk melakukan rating pada paket

          * User akan memilih dari 1 bintang sampai 5 bintang untuk memberi nilai rating
          * 1-5 kepada paket yang diview.
        -->
        @csrf
          <input type=hidden name="idUser" id="idUser" value="{{ $user -> id }}"/>
          <input type=hidden name="idPaket" id="idPaket" value="{{ $paket -> id }}"/>
          <div class="rate">
            <input type="radio" id="star5" name="rate" value="5" onclick="this.form.submit();"/>
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" onclick="this.form.submit();"/>
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" onclick="this.form.submit();"/>
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" onclick="this.form.submit();"/>
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" onclick="this.form.submit();"/>
            <label for="star1" title="text">1 star</label>
          </div>
        </form>
      </div>
    </div>
    <div class="rowv">
        <form method="POST" action="/kgweb/{{ $paket -> id }}/book">
        @csrf
          <input type="hidden" name="idCustomer" id="idCustomer" value="{{ $user -> id }}">
          <input type="hidden" name="idPaket" id="idPaket" value="{{ $paket -> id }}">
          <button class="Btn">Book Now!</button>
          
        </form>
        <span>{{ session('msg') }}</span>
        <!--Pesan untuk user apabila user sudah membooking paket yang diview-->
        <h2 style="text-align: center;padding-left:20px">Description</h2>
        <p style="text-align: center">{{ $paket -> deskripsi }}</p>
        
    </div>
    <section>
		  <div class="container" style="margin-top: -10px;">
          <!--Data penginapan dan wisata diterima oleh controller paket-->
            <table style="margin-top: 40px;margin-left: 2%">
                <tr>
                    <th colspan="2">
                        <h2>Destination</h2>
                        <img src="/css/des.jpg" style="width: 60px;padding-bottom:30px;">
                    </th>
                </tr>
                <tr>
                    <td rowspan="2" class="polaroid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <img src="/css/viewpaket.jpg">
                        @foreach ($wisatas as $w)
                          @if ($w -> id == $paket -> idWisata)
                            <p style="text-align:center;font-weight:bold">{{$w -> namaWisata}}</p>
                            <p style="text-align:center;font-weight:bold">Price: Rp {{$w -> hargaW}}</p>
                          @endif
                        @endforeach
                    </td>
                </tr>
            </table>

            <table style="margin-top: 90px;">
                <tr>
                    <th colspan="2">
                        <h2>Lodging</h2>
                        <img src="/css/lodging.png" style="width: 60px;padding-bottom:30px;">
                    </th>
                </tr>
                <tr>
                    <td rowspan="2" class="polaroid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <img src="/css/h.jpg">
                        @foreach ($penginapans as $p)
                          @if ($p -> id == $paket -> idPenginapan)
                            <p style="text-align:center;font-weight:bold">{{$p -> namaPenginapan}}</p>
                            <p style="text-align:center;font-weight:bold">Price: Rp {{$p -> hargaP}}</p>
                          @endif
                        @endforeach
                    </td>
                </tr>
            </table>
            <table style="margin-top: 100px;">
                <tr>
                    <td style="text-align: justify;padding-left: 30px">
                    <h2 style="text-align: center">Travell Tips</h2>
                        <ol style="font-size: 20px">
                            <li>Check the current COVID-19 situation at your destination.</li>
                            <li>If traveling by air, check if your airline requires any testing, vaccination, or other documents.</li>
                            <li>Prepare to be flexible during your trip as restrictions and policies may change.</li>
                            <li>Wearing a mask over your nose and mouth is required</li>
                            <li>Protect Yourself and Others by wacth the protocol</li>
                            <li>Wash your hands often with soap and water or use hand sanitizer with at least 60% alcohol.</li>
                        </ol>
                    </td>
                </tr>
            </table>
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
          Kita<span style="font-family: 'Font GO'; color:#1e90ff; margin-left:0%;font-size:50px">GO</span>
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
    <!--Footer-->
    <hr style="margin-left: 20px;margin-right: 20px;color:#333">
    <ul>
      <li>&copy 2022 KitaGO Company, Inc</li>
      <li><img src="/css/twitter.png" style="width:27px"></li>
      <li><img src="/css/instagram.png" style="width:27px"></li>
      <li><img src="/css/facebook.png" style="width:27px"></li>
    </ul>
  </footer>
  
</html>
