<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'card_number', 'gender', 'address',
        'phone', 'email', 'project_id', 'occupation', 'discount_package_id', 'active'
    ];

    /**
     * Get employee discounts.
     */
    public function discounts() 
    {
        return $this->belongsToMany('App\Project')->withPivot('discount_amount');
    }

    /**
     * Get discount package for a user.
     */
    public function discount_package()
    {
        return $this->belongsTo('App\DiscountPackage');
    }

    /**
     * Get the sales for the employee.
     */
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
}
