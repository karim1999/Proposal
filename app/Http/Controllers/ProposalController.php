<?php

namespace App\Http\Controllers;

use App\Company;
use App\Proposal;
use App\ProposalSection;
use App\Text;
use App\Theme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProposalController extends Controller
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
        $this->data['proposals']= auth()->user()->companies_proposals;
        return view('proposals.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param Request $request
     * @return Response
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

//        $text= new Text();
//        $text->value= $request->post('content');
//        $text->save();
//
//        $section= new ProposalSection();
//        $section->name= "Section";
//        $section->proposal()->associate($proposal);
//        $text->section()->save($section);

        return redirect()->route('proposals.index')->with("status", "A proposal was added successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param Proposal $proposal
     * @return void
     */
    public function show(Proposal $proposal)
    {
        //
        $this->data['proposal']= $proposal;
        return view("templates.".$proposal->theme->name, $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Proposal $proposal
     * @return Response
     */
    public function edit(Proposal $proposal)
    {
        //
        $this->data['proposal']= $proposal;
        $this->data['companies']= auth()->user()->companies;
        $this->data['themes']= Theme::all();
        return view('proposals.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Proposal $proposal
     * @return Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        //
        $validatedData = $request->validate([
            'company' => 'required',
            'name' => 'required',
            'theme' => 'required',
        ]);
        $company= Company::findOrFail($request->post('company'));
        $theme= Theme::findOrFail($request->post('theme'));
        $proposal->name= $request->post('name');
        $proposal->company()->associate($company);
        $proposal->theme()->associate($theme);

        $proposal->save();

        return redirect()->route('proposals.index')->with("status", "The proposal was edited successfully.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy(Proposal $proposal)
    {
        //
        $proposal->delete();
        return redirect()->back()->with("status", "A proposal was deleted successfully.");
    }
}
