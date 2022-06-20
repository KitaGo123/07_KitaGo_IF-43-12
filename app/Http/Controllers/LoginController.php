<?php
/** PENDAHULUAN
 * Source code ini bertujuan untuk menghubungkan view login dengan database
 * sekaligus memvalidasi user yang masuk kedalam website KitaGO. Selain itu juga, 
 * pada code ini akan ada function yang mengatur profile dari user, seperti view profile
 * dan edit profile, serta ada function yang digunakan untuk view my paket.
 * My paket adalah sebuah fitur berupa list paket yang sedang dibooking oleh customer. 
 * Dalam source code ini dibagi menjadi 7 function dengan masing-masing fungsi tertentu. 
 * DATA YANG DIOLAH : data atau models dari Customer, dan PenyediaJasa.
 */

/*Pemanggilan library dan file models*/
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
/*Login controller yang digunakan untuk merancang bagaimana data disimpan kedalam database*/
class LoginController extends Controller
{
    /*function untuk menampilkan view (halaman tampilan) dari login*/
    public function index()
    {
        /*mendefinisikan model customer dengan variabel data*/
        $data = Customer::get();
        /*mengembalikan view login*/
        return view('kgweb.login', ['list' => $data]);
    }
    /*function untuk melakukan login dan validasi login*/
    public function doLogin(Request $request)
    {
        /*mendefinisikan model customer, penyediaJasa, paket, dan rating dengan variabelnya*/
        $penginapan = Penginapan::get();
        $wisata = Wisata::get();
        $dataC = Customer::get();
        $dataA = PenyediaJasa::get();
        $paket = Paket::get();
        $rates = Rating::get();
        /*Untuk setiap data customer dichek apakah username dan password sudah benar. 
        Jika benar maka user akan masuk kedalam session dan akan dialihkan ke homepage*/
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
        /*Untuk setiap data penyedia jasa dichek apakah username dan password sudah benar. 
        Jika benar maka user akan masuk kedalam session dan akan dialihkan ke homepage*/
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
        /*Jika username atau password tidak diisi (kosong) maka akan muncul notifikasi "Silahkan isi data yang masih kosong"*/
        if ($request->username == null || $request->password == null) {
            return redirect('/kgweb/login')->with('msg', 'Silahkan isi data yang masih kosong');
        }
        /*Jika username atau password sesuai maka akan muncul notifikasi "Username dan Password tidak sesuai!"*/
        return redirect('/kgweb/login')->with('msg', 'Username dan Password tidak sesuai!');
    }
    /*function berikut digunakan untuk mengarah pada halaman profile, berdasarkan id dari user pada session */
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
    /*function berikut digunakan untuk melihat list paket yang sedang dibooking oleh customer */
    public function viewPackage($id)
    {
        /*Jika user belum melakukan login (belum ada dalam session) maka akan dialihkan pada login page*/
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        /*mendefinisikan model customer, booking, dan paket dengan variabelnya*/
        $user = Customer::find($id);
        $book = Booking::get();
        $package = Paket::get();
        /*mendefinisikan listP untuk paket dan listB untuk booking*/
        $listP = array();
        $listB = array();
        /*Untuk setiap data booking dilakukan pengechekan. Jika id user saat ini (yang sedang login)
        sama dengan id dari idCustomer pada data booking maka akan dichek pada data paketnya dan 
        booking tersebut akan masuk kedalam listB.
        Jika id paket yang telah dibooking pada user saat ini sama dengan id paket di data maka
        paket tersebut akan masuk pada listP */
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
        /*mengembalikan halaman mypackage dengan list paket yang telah dibooking oleh user saat itu  */
        return view('kgweb.mypackage', ['package' => $listP, 'book' => $listB, 'title' => "My Packages"]);
    }
    /*function berikut adalah function untuk menampilkan halaman edit profile, 
    berdasarkan id user yang ada dalam session */
    public function editProfile($id)
    {
        /*Jika user belum melakukan login (belum ada dalam session) maka akan dialihkan pada login page*/
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
    /*function berikut adalah function untuk update data profile user */
    public function updateProfile(Request $request, $id)
    {
        /*Jika user belum melakukan login (belum ada dalam session) maka akan dialihkan pada login page*/
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        /*mendefinisikan user yang ada disession dengan variabel user */
        $user = session('user');
        if (isset($user -> nama_lengkap)) {
            /*definisikan model customer dengan nama variabel data, untuk mencari id dari id user dalam session */
            $data = Customer::find($id);
                $data->id = $request->id;
                $data->nama_lengkap = $request->name;
                $data->emailC = $request->email;
                $data->birthDate = $request->birthDate;
                $data->telpNumbC = $request->telpNumb;
            /*perubahan akan disimpan dan diupdate, sesuai dengan perubahan yang dilakukan user*/
            $data->save();
            Session::put('user', $data);
            /*setelah update selesai maka akan redirect ke halaman profile */
            return redirect("/kgweb/$id/profile");
        /*jika user pada session tersebut memiliki nama_lengkap maka dia adalah penyedia jasa (proses kebawahnya sama dengan customer) */
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
    /*function ini digunakan untuk logout dari session dan akan redirect ke halaman utama dari website*/
    public function Logout(Request $request)
    {
        /*Jika user belum melakukan login (belum ada dalam session) maka akan dialihkan pada login page*/
        if (null == Session::get('user')){
            return redirect('/kgweb/login');
        }
        Session::flush();
        return redirect('/kgweb');
    }
}
