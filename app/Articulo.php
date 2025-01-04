<?php

namespace App;

use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $table = 'articulos';

    protected $fillable = [
        'name',
        'content',
        'status'
    ];
}
