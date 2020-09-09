<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    protected $table = "user_books";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'giver_id', 
        'taker_id', 
        'book_id',
        'date_start',
        'date_end',
        'status',
    ];

    public function user(){
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function book(){
        return $this->belongsTo( Book::class, 'book_id' );
    }

    public function giver(){
        return $this->belongsTo( User::class, 'giver_id' );
    }

    public function taker(){
        return $this->belongsTo( User::class, 'taker_id' );
    }
}
