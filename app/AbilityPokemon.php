<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbilityPokemon extends Model
{
    use SoftDeletes;
    
    protected $table = 'abilitypokemon';
    
    protected $hidden = ['created_at','updated_at'];
    
    protected $fillable = ['idability', 'idpokemon'];
}
