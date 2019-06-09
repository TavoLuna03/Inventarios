<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [ 'id',
                            'name',
                            'price',
                            'description',
                            'quantity',
                            'number_lote' ,
                            'category_id',
                            'expiration_date',
                            'created_at',
                            'updated_at'];
}
