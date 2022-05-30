<?php

/**
 * PENDAHULUAN
 * 
 * Tujuan : Codingan ini mendefinisikan data Rating yang bakal digunakan dalam controller Paket.
 * 
 * Deskripsi : Codingan ini merupakan codingan pendefinisian masing - masing data untuk database Penginapan.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//Mengambil library yang dibutuhkan

class Penginapan extends Model
{
    protected $primaryKey = 'id'; //Memprotect variable primaryKey sebagai 'id'
    public $incrementing = true; //Mendefinisikan auto increment untuk data id
    use HasFactory; //Mendefinisikan factory untuk auto generate data Penginapan
}
