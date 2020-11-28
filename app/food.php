<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    protected $fillable =[
        'name',
        'food_category',
        'description',
        'menu',
        'the_special',
        'food_order',
        'price',

    ];
}
