<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $table = 'post';
    
    protected $hidden = ['created_at','updated_at'];
    
    protected $fillable = ['iduser', 'subject', 'idpokemon', 'content'];
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
