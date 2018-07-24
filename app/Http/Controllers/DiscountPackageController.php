<?php

namespace App\Http\Controllers;

use App\DiscountPackage;
use App\Project;
use App\Discount;
use Illuminate\Http\Request;
use Session;

class DiscountPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = DiscountPackage::with([
            'discounts' => function($query) {
                $query->select('discounts.*', 'project_name', 'project_logo')
                    ->join('projects', 'projects.id', '=', 'discounts.project_id')
                    ->get();
            }
        ])->get();        
        return view('pages.packages.index')->with([ 'packages' => $packages ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('pages.packages.create')->with([ 'projects' => $projects ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = new DiscountPackage($request->only('package_name'));
        $package->save();

        $discounts = array();
        foreach($request->discount_amounts as $projectId => $amount) {
            array_push($discounts, new Discount([
                'discount_amount' => $amount,
                'discount_package_id' => $package->id,
                'project_id' => $projectId
            ]));
        }

        $package->discounts()->saveMany($discounts);
        $package->load('discounts');

        Session::flash('packages.created', 'Пакет скидок успешно создан.');
        return redirect()->route('packages');
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
        $package = DiscountPackage::where('id', $id)->with('discounts')->first();
        $projects = Project::with([
            'discounts' => function($query) use ($id) {
                $query->where('discount_package_id', $id);
            }
        ])->get();

        return view('pages.packages.edit')->with([
            'package' => $package,
            'projects' => $projects
        ]);
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
        $package = DiscountPackage::find($id);
        $package->package_name = $request->package_name;
        $package->save();        

        $discounts = array();
        foreach($request->discount_amounts as $projectId => $amount) {
            array_push($discounts, new Discount([
                'discount_amount' => $amount,
                'discount_package_id' => $package->id,
                'project_id' => $projectId
            ]));
        }

        $package->discounts()->delete();
        $package->discounts()->saveMany($discounts);

        Session::flash('packages.updated', 'Пакет скидок успешно изменен.');
        return redirect()->route('packages');
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
