<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    public $timestamps    = false;
    protected $table      = "shopping";
    protected $fillable   = ['id','id_bill','id_product','status','date_register','ip'];
    protected $primaryKey = 'id';
    protected $appends    = ['product_name','product_price','product_tax'];
    protected $connection = "mysql";

    public function getProductNameAttribute() {
        return $this->getProduct->name_product;
    }

    public function getProductPriceAttribute() {
        return $this->getProduct->product_price;
    }

    public function getProductTaxAttribute() {
        return $this->getProduct->product_tax;
    }

    public function getProduct() {
        return $this->belongsTo(Products::class, 'id_product');
    }
}
