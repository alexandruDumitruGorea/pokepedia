<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ability extends Model
{
    use SoftDeletes;
    
    protected $table = 'ability';
    
    protected $hidden = ['created_at','updated_at'];
    
    protected $fillable = ['ability'];
}
