<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'order_id',  'product_id', 'quantity', 'price'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'order_detail';
     public function product(){
         return $this->belongsTo(product::class,'product_id');
     }
     public function gallery(){
        return $this->hasMany(gallery::class,'product_id','product_id');
    }
}
