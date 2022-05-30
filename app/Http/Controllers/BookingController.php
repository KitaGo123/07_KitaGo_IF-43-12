<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Booking;
use App\Models\Paket;

class BookingController extends Controller
{
    public function book(Request $request, $id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $dataB = Booking::get();
        foreach ($dataB as $d) {
            if ($d -> idCustomer == $request -> idCustomer && $d -> idPaket == $request -> idPaket){
                return redirect("/kgweb/paket/$id/viewPaket")->with('msg', "You have already booked this package!");
            }
        }
        $data = new Booking;
            $data->idCustomer = $request->idCustomer;
            $data->idPaket = $request->idPaket;
            $data->tanggalBooking = date('d/m/Y');
        return view('kgweb.booking', [
            'title' => 'Booking Paket',
            'method' => 'POST',
            'action' => "kgweb/$id/booking",
            'data' => $data,
        ]);
    }

    public function booking(Request $request, $id)
    {
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        $paket = Paket::find($request->idPaket);
        $data = new Booking;
            $data->idCustomer = $request->idCustomer;
            $data->idPaket = $request->idPaket;
            $data->tanggalBooking = date('Y-m-d');
        $data->save();
        return view('kgweb.paymentmsg', ['paket' => $paket]);
    }
}
