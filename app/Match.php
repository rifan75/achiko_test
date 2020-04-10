<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'match';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match',
        'participant',
        'winner',
        'loser',
        'round',
    ];

    protected $casts = [
        'participant' => 'array'
    ];
}
