<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = 'Deal';
    protected $fillable = ['id_project','id_product','price','tva','quantity','created_at','updated_at'];
}
