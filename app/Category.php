<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    public $timestamp = false;

    public function book(){
        return $this->hasMany( Book::class, 'category_id' );
    }
}
