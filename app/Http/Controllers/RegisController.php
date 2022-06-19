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

    public function index()
    {
        $dataC = $this->customerRepo->all();
        $dataA = $this->penyediaJasaRepo->all();
        return view('kgweb.regis', ['listC' => $dataC, 'listA' => $dataA]);
    }

    public function create($type)
    {
        if ($type == 'agent' || $type == 'customer'){
            return view('kgweb.regis', [
                'title' => 'Registrasi User',
                'method' => 'POST',
                'action' => 'kgweb/registrasi',
                'type' => $type,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        if (isset($request->type)) {
            if ($request->type == "customer") {
                if ($request -> usernameC == null || $request -> passwordC == null || $request -> nama_lengkap == null || $request -> emailC == null
                || $request -> birthDate == null || $request -> telpNumbC == null) {
                    return redirect('/kgweb/regis/customer')->with('msg', 'Silahkan isi data yang masih kosong');
                } else {
                    $customers = Customer::get();
                    foreach ($customers as $c) {
                        if ($c -> usernameC == $request -> usernameC) {
                            return redirect('/kgweb/regis/customer')->with('msg', 'Username tersebut sudah diambil!');
                        } else if ($c -> emailC == $request -> emailC) {
                            return redirect('/kgweb/regis/customer')->with('msg', 'Email tersebut sudah terdaftar!');
                        }
                    }
                    $data = new Customer;
                        $data->id = $request->id;
                        $data->nama_lengkap = $request->nama_lengkap;
                        $data->emailC = $request->emailC;
                        $data->birthDate = $request->birthDate;
                        $data->telpNumbC = $request->telpNumbC;
                        $data->usernameC = $request->usernameC;
                        $data->passwordC = Hash::make($request->passwordC);
                    $data->save();
                    return redirect('/kgweb/login');
                }
            } else if ($request->type == "agent") {
                if ($request -> usernameP == null || $request -> passwordP == null || $request -> nama_penyedia_jasa == null || $request -> emailP == null
                || $request -> alamat == null || $request -> telpNumbP == null) {
                    return redirect('/kgweb/regis/agent')->with('msg', 'Silahkan isi data yang masih kosong');
                } else {
                    $pjs = PenyediaJasa::get();
                    foreach ($pjs as $p) {
                        if ($p -> usernameP == $request -> usernameP) {
                            return redirect('/kgweb/regis/agent')->with('msg', 'Username tersebut sudah diambil!');
                        } else if ($p -> emailP == $request -> emailP) {
                            return redirect('/kgweb/regis/agent')->with('msg', 'Email tersebut sudah terdaftar!');
                        }
                    }
                    $data = new PenyediaJasa;
                        $data->id = $request->id;
                        $data->nama_penyedia_jasa = $request->nama_penyedia_jasa;
                        $data->emailP = $request->emailP;
                        $data->alamat = $request->alamat;
                        $data->telpNumbP = $request->telpNumbP;
                        $data->usernameP = $request->usernameP;
                        $data->passwordP = Hash::make($request->passwordP);
                    $data->save();
                    return redirect('/kgweb/login');
                }
            }
        } else {
            return redirect('/kgweb');
        }
    }
}
