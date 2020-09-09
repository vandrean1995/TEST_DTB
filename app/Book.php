<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'author_id',
        'category_id',
        'code',
        'date',
        'place',
        'name',
        'description',
    ];

    public function author(){
        return $this->belongsTo( Author::class, 'author_id' );
    }

    public function category(){
        return $this->belongsTo( Category::class, 'category_id' );
    }

    public function user_books(){
        return $this->hasMany( UserBook::class, 'book_id' );
    }
}
