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

    /**
     * Get a user who created a sale.
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public static function getAll()
    {
        return self::select('sales.*', 'users.fullname as username', 'projects.project_name', 'employees.fullname as employee_name', 'employees.card_number', 'employees.photo')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->join('projects', 'projects.id', '=', 'sales.project_id')
            ->join('employees', 'employees.id', '=', 'sales.employee_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
