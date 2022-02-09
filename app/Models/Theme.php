<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table      = "themes";  
    protected $fillable   = ['id','description','class_name'];
    protected $connection = "mysql";
    public $timestamps    = false;
}
