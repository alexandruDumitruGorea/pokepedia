<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    protected $table = 'comment';
    
    protected $hidden = ['created_at','updated_at'];
    
    protected $fillable = ['idpost', 'iduser', 'content'];
    
    public function post() {
        return $this->belongsTo('App\Post', 'idpost');
    }
}
