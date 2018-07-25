<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discount_amount', 'discount_package_id', 'project_id'
    ];

    /**
     * Get discount package.
     */
    public function package()
    {
        return $this->belongsTo('App\DiscountPackage');
    }

    /**
     * Get discount project.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
