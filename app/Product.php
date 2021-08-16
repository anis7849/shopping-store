<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'category_id', 'image', 'status'
    ];
    public function category() {
        return $this->hasOne('App\Category','id', 'category_id');
    }
}
