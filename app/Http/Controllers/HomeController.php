<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Sale;
use App\DiscountPackage;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get();
        $discountPacks = DiscountPackage::get();
        $projects = Project::get();
        $sales = Sale::getAll();

        $salesPrices = [0, 0, 0, 0, 0, 0, 0];
        foreach ($sales as $sale) {
            $dayOfWeek = date('w', strtotime($sale->created_at));
            $salesPrices[intval($dayOfWeek)] += $sale->discount_sum;
        }

        return view('home', [
            'employees' => $employees,
            'sales' => $sales,
            'salesPrices' => $salesPrices,
            'discountPacks' => $discountPacks,
            'projects' => $projects
        ]);
    }
}
