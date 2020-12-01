<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='vp_products';
    protected $primaryKey='prod_id';
    protected $guarded=[];
}
