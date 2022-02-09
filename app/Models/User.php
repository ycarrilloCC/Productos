<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Theme;

class User extends Authenticatable
{
    protected $fillable = ['name','password','type','theme_id','status'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['email_verified_at' => 'datetime'];
    protected $appends  = ['theme_name'];
    public $timestamps  = false;

    public function getThemeNameAttribute() {
        return $this->getTheme->class_name;
    }

    public function getTheme() {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
