<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['usernameC'];

    protected $primaryKey = 'id';
    public $incrementing = true;
    use HasFactory;
}
