<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class star_rating extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'product_id',  'star',  'customer_id', 'order_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'star_rating';
}
