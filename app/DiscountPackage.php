<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountPackage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package_name'
    ];

    /**
     * Get all discounts for a package.
     */
    public function discounts() 
    {
        return $this->hasMany('App\Discount');
    }
}
