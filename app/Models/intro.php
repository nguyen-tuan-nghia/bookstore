<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intro extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'id',  'content'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'intro';
}
