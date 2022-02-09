<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps    = false;
    protected $table      = "bill";
    protected $fillable   = ['id','id_user','status','date_billing','date_register','ip'];
    protected $primaryKey = 'id';
    protected $appends    = ['shopping','user_name'];
    protected $connection = "mysql";


    public function getShoppingAttribute(){
        return $this->getShopping;
    }

    public function getUserNameAttribute(){
        return $this->getUser->name;
    }

    public function getShopping(){
        return $this->hasMany(Shopping::class, 'id_bill')->orderBy('id', 'asc');
    }

    public function getUser() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
