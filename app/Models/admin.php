<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'name',  'email', 'password'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'admin';
     public function admin_role(){
         return $this->hasMany(admin_role::class);
     }
}
