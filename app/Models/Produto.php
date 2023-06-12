<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produtos";
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'datacompra',
        'dataval'
    ];
}
