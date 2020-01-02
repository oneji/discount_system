<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Employee;
use Session;
use Auth;
use Carbon\Carbon;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::forget('saleData');
        $sales = Sale::select('sales.*', 'users.fullname as username', 'projects.project_name', 'employees.fullname as employee_name', 'employees.card_number')
                        ->join('users', 'users.id', '=', 'sales.user_id')
                        ->join('projects', 'projects.id', '=', 'sales.project_id')
                        ->join('employees', 'employees.id', '=', 'sales.employee_id')
                        ->get();

        return view('pages.sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        if(count(Session::get('saleData')) > 0) {
            $saleData = Session::get('saleData');

            return view('pages.sales.create')->with('saleData', $saleData);
        } else 
            return redirect()->route('sales.index');
    }

    /**
     * Check if card number exists in the database.
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkCard(Request $request) 
    {
        $totalSum = $request->total_sum;
        $accountNum = $request->account_num;
        $cardNumber = $request->card_number;
        $projectId = Auth::user()->project_id;        

        $employee = Employee::where('card_number', $cardNumber)->first();

        if($employee) {
            $employee->load([
                'discounts' => function($query) use ($projectId) {
                    $query->where('id', $projectId)->first();
                }, 
                'discount_package.discounts' => function($query) use ($employee) {
                    $query->where('discount_package_id', $employee->discount_package_id)->first();
                }
            ])->first();
            
            if($employee->discount_package === null) {
                $discountAmount = $employee->discounts[0]->pivot->discount_amount;
            } else {
                $discountAmount = $employee->discount_package->discounts[0]->discount_amount;
            }
            $discountSum = $this->getPercentage($totalSum, $discountAmount);

            Session::push('saleData', [
                'employee' => $employee,
                'account_num' => $accountNum,
                'total_sum' => $totalSum,
                'discount_amount' => $discountAmount,
                'discount_sum' => (int) $totalSum - (int) $discountSum
            ]);
            return redirect()->route('sales.create');
        } else {
            Session::flash('sales.check.failed', 'Сотрудника с таким номером карты не найдено!');
            return redirect()->route('sales.index');
        }
    }

    /**
     * Store a newly created resource in the database.
     */
    public function store(Request $request)
    {
        $saleData = Session::get('saleData');
        $sale = new Sale();
        $sale->user_id = Auth::user()->id;
        $sale->project_id = Auth::user()->project_id;
        $sale->employee_id = $saleData[0]['employee']->id;
        $sale->receipt_number = $saleData[0]['account_num'];
        $sale->total_sum = $saleData[0]['total_sum'];
        $sale->discount_amount = $saleData[0]['discount_amount'];
        $sale->discount_sum = $saleData[0]['discount_sum'];
        $sale->sale_date = Carbon::now();
        $sale->save();

        Session::flash('sales.created', 'Продажа успешно оформлена.');
        return redirect()->route('sales.index');
    }

    /**
     * Helper function. Count number percentage.
     */
    private function getPercentage($number, $percent) 
    {
        return (int) $number * ( (int) $percent / 100 );
    }
}
