<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * Get a user who created a sale.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
