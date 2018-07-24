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
        'phone', 'email', 'project_name', 'occupation', 'discount_package_id', 'active'
    ];
}
