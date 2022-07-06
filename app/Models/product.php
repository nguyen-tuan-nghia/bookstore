<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',  'slug',  'cost_price',  'price', 'category_id', 'old_price', 'quantity', 'sale', 'sell', 'content', 'status', 'created_at'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'product';
     public function gallery(){
        return $this->hasMany(gallery::class,'product_id');
    }
    public function category(){
        return $this->belongsTo(category::class,'category_id');
    }
}
