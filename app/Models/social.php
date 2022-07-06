<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class social extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'provider_user_id',  'provider',  'user_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'social';
 	public function login(){
 		return $this->belongsTo('App\Models\User', 'user_id');
 	}
}
