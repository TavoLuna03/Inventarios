<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['estatus', 
                            'state', 
                            'reference_sale',
                            'total'];
}
