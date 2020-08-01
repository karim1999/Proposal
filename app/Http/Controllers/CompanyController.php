<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public $data= [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['companies']= auth()->user()->companies;
        return view('companies.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['company']= new Company();
        return view('companies.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'logo' => 'required|image',
            'name' => 'required',
            'website' => 'required|URL',
        ]);
        $company= new Company();
        $company->name= $request->post('name');
        $company->website= $request->post('website');
        auth()->user()->companies()->save($company);
        $company->addMediaFromRequest("logo")->toMediaCollection('logo');
        return redirect()->route('companies.index')->with("status", "A company was added successfully.");
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
        $this->data['company']= Company::findOrFail($id);
        return view('companies.form', $this->data);
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
        $validatedData = $request->validate([
            'name' => 'required',
            'website' => 'required|URL',
        ]);
        $company= Company::findOrFail($id);
        $company->name= $request->post('name');
        $company->website= $request->post('website');
        $company->save();
        if($request->file('logo'))
            $company->addMediaFromRequest("logo")->toMediaCollection('logo');
        return redirect()->route('companies.index')->with("status", "The company was edited successfully.");
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
        Company::destroy($id);
        return redirect()->route('companies.index')->with("status", "A company was deleted successfully.");
    }
}
