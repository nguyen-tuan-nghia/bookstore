<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class web_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'logo', 'keywords', 'address', 'email', 'phone', 'fan_page'
  ];
  protected $primaryKey = 'id';
   protected $table = 'web_detail';
}
