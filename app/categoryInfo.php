<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryInfo extends Model
{
    /**
     * This attribute defines table name.
     */
    protected $table = 'cat_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
    ];
}
