<?php

/**
 * PENDAHULUAN

 * Tujuan : Controller ini digunakan untuk memberi dan melihat nilai rating masing - masing paket oleh 
 * user kemudian memasukkannya ke dalam database Rating.

 * Deskripsi : Controller ini hanya memiliki 2 function/method yang akan digunakan untuk rate dan view
 * rate. 2 function tersebut adalah : viewRating dan rate.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//Memanggil library yang dibutuhkan
use App\Models\Rating; //Controller ini hanya menggunakan data/model Rating

class RatingController extends Controller
{
    //Function untuk melihat rating
    public function viewRating(Request $request, $id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $rate = Rating::get(); //Mengambil data rating yang disimpan dalam database
        foreach ($rate as $r) {
            if ($r -> idPaket == $request -> idPaket){
                $check .= [
                    'paket' => $r -> idPaket,
                    'checked' => "checked",
                ];
                foreach ($rate as $rs) {
                    if ($r -> idPaket == $rs -> idPaket) {
                        $value .=+ $rs -> rating;
                        $count .=+ 1;
                    }
                }
                $avg = intdiv($value, $count);
                $rating .= [
                    'paket' => $r -> idPaket,
                    'avgValue' => $avg,
                ];
                //Menghitung nilai rata - rata rating dari masing - masing paket
            }
        }
        Session::put('rating', $rating);
        return redirect("/kgweb/paket/$id/viewPaket")->with('msg', $rating);
        //Menyimpan data rating ke dalam session
    }

    //Function untuk melakukan rating
    public function rate(Request $request, $id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $rateData = Rating::get(); //Mengambil data rating yang disimpan dalam database
        foreach ($rateData as $rD) {
            if (isset($rD -> idUser)) {
                if ($rD -> idUser == $request -> idUser && $rD -> idPaket == $request -> idPaket) {
                    //Update Rating
                    $data = Rating::find($rD -> id); //Mengambil data rating dari database berdasarkan id
                        $data->idUser = $request->idUser;
                        $data->idPaket = $request->idPaket;
                        $data->rating = $request->rate;
                        //Memasukkan data terbaru untuk data paket
                    $data->save(); //Menyimpan data terbaru
                    $rate = Rating::get(); //Mengambil seluruh data rating terbaru
                    Session::put('rates', $rate); //Menyimpan data rating ke dalam session
                    return redirect("/kgweb/paket/$id/viewPaket"); //Membuka view viewPaket
                }
            }
        }
        //Insert rating
        $data = new Rating; //Membuat data rating baru
            $data->idUser = $request->idUser;
            $data->idPaket = $request->idPaket;
            $data->rating = $request->rate;
            //Memasukkan data terbaru untuk data rating
        $data->save(); //Menyimpan data terbaru
        $rate = Rating::get(); //Mengambil seluruh data rating terbaru
        Session::put('rates', $rate); //Menyimpan data rating ke dalam session
        return redirect("/kgweb/paket/$id/viewPaket"); //Membuka view viewPaket
    }
}
