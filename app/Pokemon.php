<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use SoftDeletes;
    
    protected $table = 'pokemon';
    
    protected $hidden = ['created_at','updated_at'];
    
    protected $fillable = ['nombre', 'altura', 'peso', 'img'];
}
