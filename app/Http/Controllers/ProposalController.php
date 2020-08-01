<?php

namespace App\Http\Controllers;

use App\Company;
use App\Proposal;
use App\Theme;
use Illuminate\Http\Request;

class ProposalController extends Controller
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
        $this->data['proposals']= auth()->user()->companies_proposals;
        return view('proposals.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['proposal']= new Proposal();
        $this->data['companies']= auth()->user()->companies;
        $this->data['themes']= Theme::all();
        return view('proposals.form', $this->data);
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
            'company' => 'required',
            'name' => 'required',
            'theme' => 'required',
        ]);
        $company= Company::findOrFail($request->post('company'));
        $theme= Theme::findOrFail($request->post('theme'));
        $proposal= new Proposal();
        $proposal->name= $request->post('name');
        $proposal->company()->associate($company);
        $proposal->theme()->associate($theme);
        auth()->user()->proposals()->save($proposal);
        $proposal->user()->associate(auth()->user());

        return redirect()->route('proposals.index')->with("status", "A proposal was added successfully.");
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
        $this->data['proposal']= Proposal::findOrFail($id);
        $this->data['companies']= auth()->user()->companies;
        $this->data['themes']= Theme::all();
        return view('proposals.form', $this->data);
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
            'company' => 'required',
            'name' => 'required',
            'theme' => 'required',
        ]);
        $company= Company::findOrFail($request->post('company'));
        $theme= Theme::findOrFail($request->post('theme'));
        $proposal= Proposal::findORFail($id);
        $proposal->name= $request->post('name');
        $proposal->company()->associate($company);
        $proposal->theme()->associate($theme);

        $proposal->save();

        return redirect()->route('proposals.index')->with("status", "The proposal was edited successfully.");

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
        //
        Proposal::destroy($id);
        return redirect()->route('proposals.index')->with("status", "A proposal was deleted successfully.");
    }
}
