<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();        
        return view('pages.projects.index', [ 'projects' => $projects ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('project_logo')) {
            $fileExtension = $request->file('project_logo')->getClientOriginalExtension();
            $fileNameToStore = uniqid().'.'.$fileExtension;
            $path = $request->file('project_logo')->move(public_path('/uploads/project_logos'), $fileNameToStore);  
        } else {
            $fileNameToStore = null;
        }

        $project = new Project($request->all());
        $project->project_logo = $fileNameToStore;
        $project->save(); 
        
        Session::flash('projects.added', 'Проект успешно добавлен.');
        return redirect()->route('projects');
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
