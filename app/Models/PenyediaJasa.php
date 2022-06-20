<?php
/*PENDAHULUAN
Source code ini adalah melakukan pendefinisian model dari penyedia jasa dimana didalamnya
id menjadi primary key dan id tersebut dilakukan auto increment*/

/*Pemanggilan library*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyediaJasa extends Model
{
     /*memprotect variabel primary key sebagai id*/
    protected $primaryKey = 'id';
    /*mendefinisikan auto increment */
    public $incrementing = true;
    /*mendefinisikan factory untuk auto generate data peyedia jasa*/
    use HasFactory;
}
