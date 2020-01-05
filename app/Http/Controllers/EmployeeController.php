<?php

namespace App\Http\Controllers;

use App\Employee;
use App\DiscountPackage;
use App\Project;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::select('employees.*', 'package_name', 'project_name')
                                ->leftJoin('discount_packages', 'discount_packages.id', '=', 'employees.discount_package_id')
                                ->join('projects', 'projects.id', '=', 'employees.project_id')
                                ->with('discounts')->get();

        return view('pages.employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = DiscountPackage::all();
        $projects = Project::all();

        return view('pages.employees.create')->with([
            'packages' => $packages,
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('photo')) {
            $fileExtension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = uniqid().'.'.$fileExtension;
            $path = $request->file('photo')->move(public_path('/uploads/employee_photos'), $fileNameToStore);
        } else {
            $fileNameToStore = null;
        }

        $employee = new Employee($request->all());

        if($fileNameToStore !== null)
            $employee->photo = $fileNameToStore;

        if($request->birthday !== null && $request->birthday !== 'null')
            $employee->birthday = Carbon::parse($request->birthday);
        
        if($request->work_start_date !== null && $request->work_start_date !== 'null')
            $employee->work_start_date = Carbon::parse($request->work_start_date);        

        $employee->save();

        if($employee->discount_package_id === null) {
            $discounts = array();
            foreach($request->discount_amounts as $projectId => $amount) {
                $employee->discounts()->attach($projectId, [
                    'discount_amount' => $amount
                ]);
            }
        }
        
        Session::flash('employees.created', 'Сотрудник успешно создан.');
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
