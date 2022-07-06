<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ship extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'order_id',  'name', 'phone', 'note', 'city', 'price', 'address'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'ship';
}
