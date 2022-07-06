<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'product_id',  'image'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'gallery';
}
