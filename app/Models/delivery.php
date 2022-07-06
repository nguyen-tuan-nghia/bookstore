<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'city',  'price'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'delivery';
}
