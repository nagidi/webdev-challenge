<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryInfo extends Model
{
     /**
     * This attribute defines table name.
     */
    protected $table = 'inventory_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category','date','lot_title','lot_condition','lot_location','pre_tax_amount','tax_name','tax_amount'
    ];
}
