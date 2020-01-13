<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxInfo extends Model
{
    /**
     * This attribute defines table name.
     */
    protected $table = 'tax_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_name',
    ];
}
