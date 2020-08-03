<?php

namespace App\Http\Controllers;

use App\Company;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CompanyController extends Controller
{
    public $data= [];
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Response
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
     * @param Request $request
     * @return Response
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
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
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company  $company
     * @return Response
     */
    public function edit(Company $company)
    {
        //
        $this->data['company']= $company;
        return view('companies.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return Response
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Company $company)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'website' => 'required|URL',
        ]);
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
     * @param Company $company
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Company $company)
    {
        //
        $company->delete();
        return redirect()->route('companies.index')->with("status", "A company was deleted successfully.");
    }
}
