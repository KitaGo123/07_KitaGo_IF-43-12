<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Repositories\CustomerRepository;
use App\Repositories\PenyediaJasaRepository;
use App\Models\Customer;
use App\Models\PenyediaJasa;

class RegisController extends Controller
{
    private CustomerRepository $customerRepo;
    private PenyediaJasaRepository $penyediaJasaRepo;

    public function __construct(CustomerRepository $customerRepo, PenyediaJasaRepository $penyediaJasaRepo) 
    {
        $this->customerRepo = $customerRepo;
        $this->penyediaJasaRepo = $penyediaJasaRepo;
    }

    public function index() /*fungsi create */
    {
        $dataC = $this->customerRepo->all(); /*meminta aksespengolahan data DB Kitago tabel customer */
        $dataA = $this->penyediaJasaRepo->all(); /*meminta aksespengolahan data DB Kitago tabel penyedia jasa */
        return view('kgweb.regis', ['listC' => $dataC, 'listA' => $dataA]); /*menampilkan view halaman registtrasi */
    }

    public function create($type) /*fungsi create */
    {
        if ($type == 'agent' || $type == 'customer'){
            return view('kgweb.regis', [ /*menampilkan view halaman registrasi */
                'title' => 'Registrasi User', /*Titllenya Registrasi User */
                'method' => 'POST', /*pengiriman informasi metode post */
                'action' => 'kgweb/registrasi', /*data diolah di registrasi */
                'type' => $type,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request) /*melakukan request ke web kitago */
    {
        if (isset($request->type)) {
            if ($request->type == "customer") { /*jika tipe registrasinya traveler/customer */
                if ($request -> usernameC == null || $request -> passwordC == null || $request -> nama_lengkap == null || $request -> emailC == null
                || $request -> birthDate == null || $request -> telpNumbC == null) { /*jika ada salah satu keadaan pengisian formulir yang masih kosong */
                    return redirect('/kgweb/regis/customer')->with('msg', 'Silahkan isi data yang masih kosong'); /*menampilkan pesan error karena masih kosong */
                } else {
                    $customers = Customer::get();
                    foreach ($customers as $c) {
                        if ($c -> usernameC == $request -> usernameC) { /*jika username customer sudah ada di db */
                            return redirect('/kgweb/regis/customer')->with('msg', 'Username tersebut sudah diambil!'); /*menampilkan pesan error kerna username sudah diambil */
                        } else if ($c -> emailC == $request -> emailC) { /*jika email customer sudah ada di db */
                            return redirect('/kgweb/regis/customer')->with('msg', 'Email tersebut sudah terdaftar!'); /*menampilkan pesan error kerna email sudah diambil */
                        }
                    }
                    $data = new Customer; /*menambahkan data pada DB tabel Customer*/
                        $data->id = $request->id;
                        $data->nama_lengkap = $request->nama_lengkap;
                        $data->emailC = $request->emailC;
                        $data->birthDate = $request->birthDate;
                        $data->telpNumbC = $request->telpNumbC;
                        $data->usernameC = $request->usernameC;
                        $data->passwordC = Hash::make($request->passwordC);
                    $data->save(); /*menyimpan data ke DB kitago tabel Customer*/
                    return redirect('/kgweb/login'); /*mengarahkan ke halaman login */
                }
            } else if ($request->type == "agent") { /*jika tipe registrasinya Agent travel */
                if ($request -> usernameP == null || $request -> passwordP == null || $request -> nama_penyedia_jasa == null || $request -> emailP == null
                || $request -> alamat == null || $request -> telpNumbP == null) { /*jika ada salah satu keadaan pengisian formulir yang masih kosong */
                    return redirect('/kgweb/regis/agent')->with('msg', 'Silahkan isi data yang masih kosong'); /*menampilkan pesan error karena masih kosong */
                } else {
                    $pjs = PenyediaJasa::get();
                    foreach ($pjs as $p) {
                        if ($p -> usernameP == $request -> usernameP) { /*jika username agent travel sudah ada di db */
                            return redirect('/kgweb/regis/agent')->with('msg', 'Username tersebut sudah diambil!'); /*menampilkan pesan error kerna username sudah diambil */
                        } else if ($p -> emailP == $request -> emailP) { /*jika email agent travel sudah ada di db */
                            return redirect('/kgweb/regis/agent')->with('msg', 'Email tersebut sudah terdaftar!'); /*menampilkan pesan error kerna email sudah diambil */
                        }
                    }
                    $data = new PenyediaJasa; /*menambahkan data pada DB tabel Customer*/
                        $data->id = $request->id;
                        $data->nama_penyedia_jasa = $request->nama_penyedia_jasa;
                        $data->emailP = $request->emailP;
                        $data->alamat = $request->alamat;
                        $data->telpNumbP = $request->telpNumbP;
                        $data->usernameP = $request->usernameP;
                        $data->passwordP = Hash::make($request->passwordP);
                    $data->save(); /*menyimpan data ke DB kitago tabel PenyediaJasa*/
                    return redirect('/kgweb/login'); /*mengarahkan ke halaman login */
                }
            }
        } else {
            return redirect('/kgweb');
        }
    }
}
