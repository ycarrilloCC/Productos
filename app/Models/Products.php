<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps    = false;
    protected $table      = "products";
    protected $fillable   = ['id','name_product','product_price','product_tax','status','date_register','ip'];
    protected $primaryKey = 'id';
    protected $connection = "mysql";
}
