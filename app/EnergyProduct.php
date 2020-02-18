<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnergyProduct extends Model
{
    protected $guarded = [  'id' ];

    public function getConvertedQtyAttribute()
        {
            return $this->quantity*1000;
        }

}
