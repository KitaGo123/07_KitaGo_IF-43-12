<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Rating;

class RatingController extends Controller
{
    public function viewRating(Request $request, $id)
    {
        $rate = Rating::get();
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
            }
        }
        Session::put('rating', $rating);
        return redirect("/kgweb/paket/$id/viewPaket")->with('msg', $rating);
    }

    public function rate(Request $request, $id)
    {
        $rateData = Rating::get();
        foreach ($rateData as $rD) {
            if (isset($rD -> idUser)) {
                if ($rD -> idUser == $request -> idUser && $rD -> idPaket == $request -> idPaket) {
                    $data = Rating::find($rD -> id);
                        $data->idUser = $request->idUser;
                        $data->idPaket = $request->idPaket;
                        $data->rating = $request->rate;
                    $data->save();
                    $rate = Rating::get();
                    Session::put('rates', $rate);
                    return redirect("/kgweb/paket/$id/viewPaket");
                }
            }
        }
        $data = new Rating;
            $data->idUser = $request->idUser;
            $data->idPaket = $request->idPaket;
            $data->rating = $request->rate;
        $data->save();
        $rate = Rating::get();
        Session::put('rates', $rate);
        return redirect("/kgweb/paket/$id/viewPaket");
    }
}
