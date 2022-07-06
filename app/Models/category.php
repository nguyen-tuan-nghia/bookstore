<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',  'slug',  'category_parent', 'keywords', 'status'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'category';

}
