<!DOCTYPE html>
<!--
 * PENDAHULUAN

 * Tujuan : Codingan ini bertujuan sebagai form untuk mengisi data - data pada paket apabila user
 * perlu menambah atau mengubah data pada paket.

 * Deskripsi : Codingan ini merupakan view untuk menampilkan form pengisian data paket.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitaGO - {{$title}}</title>
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
        <!--Header-->
        <div class="cont">
            <div class="header-left">
            Kita<span style="font-family: 'Font GO'; color:white">GO</span>
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
            <a href="/kgweb">Home</a> 
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
            <a href="/kgweb">Home</a> 
          </div>
        @endif
    </header>
    <div class="row-paket">
      <div class="col-paket">
        <div class= "form-P">
          <p>{{$title}}</p>
          <input type="hidden" name="userID" value="{{ $user = session('user'); }}">
          <input type="hidden" name="penID" value="{{ $penginapan = session('penginapan'); }}">
          <input type="hidden" name="wisID" value="{{ $wisata = session('wisata'); }}">
          <form method="POST" action="/{{$action}}">
          @csrf
            <input type="hidden" name="_method" value="{{ $method }}" />
              <!--
                * Form untuk melakukan proses input atau update data paket

                * Setiap field input diisi oleh data paket apabila user melakukan update. Data
                * paket diambil dari data yang dikirimkan oleh controller paket. Data tersebut
                * kemudian dimasukkan ke dalam field namaPaket, idWisata, idPenginapan, harga, 
                * dan deskripsi.
              -->
              <div class="form-groupP" style="text-align: left;">
                <label>Nama Paket</label><br>
                <input type="text" class="form-control" name="namaPaket" id="namaPaket" placeholder="Masukkan nama paket" value="{{ isset($data)?$data->namaPaket:'' }}">
              </div>
  
              <div class="form-groupP" style="text-align: left;">
                <label>Nama Wisata</label><br>
                <select class="form-control" name="idWisata" id="idWisata">
                  @foreach ($wisata as $w)
                    @if (isset($data))
                      @if ($w -> id == $data -> idWisata)
                        <option value="{{ isset($data)?$data->idWisata:'' }}" disabled selected hidden>{{ $w -> namaWisata}}</option>
                      @endif
                    @endif
                    <option value="{{ $w -> id }}">{{ $w -> namaWisata}}</option>
                  @endforeach
                </select>
              </div>
  
              <div class="form-groupP" style="text-align: left;">
                <label>Nama Penginapan</label><br>
                <select class="form-control" name="idPenginapan" id="idPenginapan">
                  @foreach ($penginapan as $p)
                    @if (isset($data))
                      @if ($p -> id == $data -> idPenginapan)
                        <option value="{{ isset($data)?$data->idPenginapan:'' }}" disabled selected hidden>{{ $p -> namaPenginapan}}</option>
                      @endif
                    @endif
                    <option value="{{ $p -> id }}">{{ $p -> namaPenginapan}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-groupP" style="text-align: left;">
                <label>Harga</label><br>
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga paket" value="{{ isset($data)?$data->harga:'' }}">
              </div>

              <input type="hidden" name="idJasa" id="idJasa" value="{{ isset($user)?$user->id:'' }}">

              <div class="form-groupP" style="text-align: left;">
                <label>Deskripsi</label><br>
                <textarea rows="10" cols="100" name="deskripsi" id="deskripsi" placeholder="Tuliskan deskripsi paket di sini" class="form-control">{{isset($data)?$data->deskripsi:'' }}</textarea>
              </div>

              <input type="hidden" name="add" id="add" value="">
              <p>{{ session('msg') }}</p>
              <!--Pesan error apabila terjadi error saat menginput data-->
              <button class="BtnL">SAVE</button>
              <!--Mengirim data yang diinputkan oleh user ke controller paket dan menyimpannya ke data paket-->
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
