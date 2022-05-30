<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\PenyediaJasa;
use App\Models\Paket;
use App\Models\Rating;
use App\Models\Booking;
use App\Models\Penginapan;
use App\Models\Wisata;

use Input;
use Auth;
use Redirect;

class LoginController extends Controller
{
    public function index()
    {
        $data = Customer::get();
        return view('kgweb.login', ['list' => $data]);
    }

    public function doLogin(Request $request)
    {
        $penginapan = Penginapan::get();
        $wisata = Wisata::get();
        $dataC = Customer::get();
        $dataA = PenyediaJasa::get();
        $paket = Paket::get();
        $rates = Rating::get();
        foreach ($dataC as $dC) {
            if ($dC->usernameC == $request->username && Hash::check($request->password, $dC->passwordC)) {
                Session::put('user', $dC);
                Session::put('paket', $paket);
                Session::put('rates', $rates);
                Session::put('pjasa', $dataA);
                Session::put('penginapan', $penginapan);
                Session::put('wisata', $wisata);
                return redirect('/');
            }
        }
        foreach ($dataA as $dA) {
            if ($dA->usernameP == $request->username && Hash::check($request->password, $dA->passwordP)) {
                Session::put('user', $dA);
                Session::put('paket', $paket);
                Session::put('rates', $rates);
                Session::put('pjasa', $dataA);
                Session::put('penginapan', $penginapan);
                Session::put('wisata', $wisata);
                return redirect('/');
            }
        }
        if ($request->username == null || $request->password == null) {
            return redirect('/kgweb/login')->with('msg', 'Silahkan isi data yang masih kosong');
        }
        return redirect('/kgweb/login')->with('msg', 'Username dan Password tidak sesuai!');
    }

    public function viewProfile($id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        return view('kgweb.viewProfile', [
            'title' => 'My Profile',
            'method' => 'GET',
            'action' => "kgweb/$id/profile",
        ]);  
    }

    public function viewPackage($id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $user = Customer::find($id);
        $book = Booking::get();
        $package = Paket::get();
        $listP = array();
        $listB = array();
        foreach ($book as $b) {
            if ($b -> idCustomer == $user -> id) {
                foreach ($package as $p) {
                    if ($b -> idPaket == $p -> id) {
                        array_push($listP, $p);
                    }
                }
                array_push($listB, $b);
            }
        }
        return view('kgweb.mypackage', ['package' => $listP, 'book' => $listB, 'title' => "My Packages"]);
    }

    public function editProfile($id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        return view('kgweb.viewProfile', [
            'title' => 'Edit Profile',
            'method' => 'PUT',
            'action' => "kgweb/$id/updateProfile",
            'edit' => 'edit',
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $user = session('user');
        if (isset($user -> nama_lengkap)) {
            $data = Customer::find($id);
                $data->id = $request->id;
                $data->nama_lengkap = $request->name;
                $data->emailC = $request->email;
                $data->birthDate = $request->birthDate;
                $data->telpNumbC = $request->telpNumb;
            $data->save();
            Session::put('user', $data);
            return redirect("/kgweb/$id/profile");
        } else if (isset($user -> nama_penyedia_jasa)) {
            $data = PenyediaJasa::find($id);
                $data->id = $request->id;
                $data->nama_penyedia_jasa = $request->name;
                $data->emailP = $request->email;
                $data->alamat = $request->alamat;
                $data->telpNumbP = $request->telpNumb;
            $data->save();
            Session::put('user', $data);
            return redirect("/kgweb/$id/profile");
        }
    }

    public function Logout(Request $request)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        Session::flush();
        return redirect('/kgweb');
    }
}
