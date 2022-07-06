<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'user_id',  'status', 'payment_type', 'created_at'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'order';
}
