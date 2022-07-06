<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',  'slug', 'content', 'status', 'image', 'created_at'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'post';
}
