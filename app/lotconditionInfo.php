<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lotconditionInfo extends Model
{
    /**
     * This attribute defines table name.
     */
    protected $table = 'lotcondition_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lot_condition',
    ];
}
