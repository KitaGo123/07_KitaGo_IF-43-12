<?php

/**
 * PENDAHULUAN

 * Tujuan : Controller ini digunakan untuk melakukan insert, update, delete, dan read data paket serta
 * melakukan view terhadap data paket tersebut.

 * Deskripsi : Controller ini memiliki 7 total function/method yang akan digunakan untuk mengatur API
 * pada web. 7 function tersebut adalah : index, createPaket, insertPaket, editPaket, updatePaket,
 * deletePaket, viewPaket.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//Memanggil library yang dibutuhkan
use App\Models\Paket;
use App\Models\Penginapan;
use App\Models\Wisata;
use App\Models\Rating;
//Controller ini menggunakan data/model Paket, Penginapan, Wisata, dan Rating

class PaketController extends Controller
{
    //Function untuk mengubah view ke form paket
    public function index()
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $data = Paket::get();
        return view('kgweb.paket', ['list' => $data]);
    }

    //Function untuk mendefinisikan variable pada form paket insert
    public function createPaket()
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        return view('kgweb.paket', [
            'title' => 'Create Package',
            'method' => 'POST',
            'action' => 'kgweb/paket/inputPaket'
        ]); //Membuka view form paket dan definisikan beberapa variable
    }

    //Function untuk menginsert paket ke dalam database
    public function inputPaket(Request $request)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        if ($request -> namaPaket == null || $request -> harga == null || $request -> idPenginapan == null || $request -> idWisata == null) {
            return redirect('/kgweb/paket/createPaket')->with('msg', 'Silahkan isi data yang masih kosong'); 
            //Cek apabila ada form yang masih kosong
        } else {
            if ($request -> deskripsi == null) {
                $request -> deskripsi = ""; //Cek apabila user memasukkan deskripsi
            }
            $data = new Paket; //Membuat data paket baru
                $data->id = $request->id;
                $data->deskripsi = $request->deskripsi;
                $data->namaPaket = $request->namaPaket;
                $data->harga = $request->harga;
                $data->idPenginapan = $request->idPenginapan;
                $data->idWisata = $request->idWisata;
                $data->idJasa = $request->idJasa;
                //Memasukkan data terbaru untuk data paket
            $data->save(); //Menyimpan data terbaru
            $paket = Paket::get(); //Mengambil seluruh data paket terbaru
            Session::put('paket', $paket); //Memasukkan data paket ke dalam session
            return redirect('/kgweb'); //Mengembalikan view ke halaman utama
        }
    }

    //Function untuk mendefinisikan variable pada form paket update
    public function editPaket($id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        return view('kgweb.paket', [
            'title' => 'Edit Package',
            'method' => 'PUT',
            'action' => "kgweb/paket/$id/updatePaket",
            'data' => Paket::find($id)
        ]);  //Membuka view form paket dan definisikan beberapa variable
    }

    //Function untuk mengupdate paket yang ada dalam database
    public function updatePaket(Request $request, $id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        if ($request -> namaPaket == null || $request -> harga == null || $request -> idPenginapan == null || $request -> idWisata == null) {
            return redirect("/kgweb/paket/$id/editPaket")->with('msg', 'Silahkan isi data yang masih kosong'); 
            //Cek apabila ada form yang masih kosong
        } else {
            if ($request -> deskripsi == null) {
                $request -> deskripsi = ""; //Cek apabila user memasukkan deskripsi
            }
            $data = Paket::find($id); //Mengambil data paket berdasarkan id
                $data->id = $request->id;
                $data->deskripsi = $request->deskripsi;
                $data->namaPaket = $request->namaPaket;
                $data->harga = $request->harga;
                $data->idPenginapan = $request->idPenginapan;
                $data->idWisata = $request->idWisata;
                $data->idJasa = $request->idJasa;
                //Memasukkan data terbaru untuk data paket
            $data->save(); //Menyimpan data terbaru
            $paket = Paket::get(); //Mengambil seluruh data paket terbaru
            Session::put('paket', $paket); //Memasukkan data paket ke dalam session
            return redirect('/kgweb'); //Mengembalikan view ke halaman utama
        }
    }

    //Function untuk mendelete paket dari dalam database
    public function deletePaket($id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $ratings = Rating::get(); //Mengambil seluruh data rating
        foreach ($ratings as $r) {
            if ($r -> idPaket == $id) {
                Rating::destroy($r -> id); //Menghapus rating dari paket terlebih dahulu
            }
        }
        Paket::destroy($id); //Menghapus paket berdasarkan id
        $paket = Paket::get(); //Mengambil seluruh data paket
        $rating = Rating::get(); //Mengambil seluruh data rating
        Session::put('rating', $rating);
        Session::put('paket', $paket);
        //Memasukkan variable paket dan rating ke dalam session
        return redirect('/kgweb'); //Mengembalikan view ke halaman utama
    }

    //Function untuk melihat view paket
    public function viewPaket($id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $paket = Paket::find($id); //Mengambil data paket berdasarkan id
        $wisata = Wisata::get(); //Mengambil seluruh data wisata
        $penginapan = Penginapan::get(); //Mengambil seluruh data penginapan
        return view('kgweb.viewpaket', ['wisatas' => $wisata, 'penginapans' => $penginapan, 'paket' => $paket]);
        //Mengubah view ke view paket dan mendefinisikan wisata, penginapan, dan paket yang diview
    }
}
