<?php

namespace App\Http\Controllers;

use App\Image;
use App\Proposal;
use App\ProposalSection;
use App\Text;
use App\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProposalSectionController extends Controller
{
    public $data= [];

    /**
     * Display a listing of the resource.
     *
     * @param Proposal $proposal
     * @return Response
     */
    public function index(Proposal $proposal)
    {
        //
        $this->data['proposal']= $proposal;
        $this->data['sections']= $proposal->sections;
        return view('sections.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Proposal $proposal
     * @param $type
     * @return Response
     */
    public function create(Proposal $proposal, $type)
    {
        //
        $this->data['proposal']= $proposal;
        $this->data['type']= $type;
        $this->data['section']= new ProposalSection();
        return view('sections.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Proposal $proposal
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Proposal $proposal)
    {
        //
        return $request;
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $type= $request->post('type');
        $mediable= "";
        if($type == "text")
            $mediable= new Text();
        else if($type == "image")
            $mediable= new Image();
        else if($type == "video")
            $mediable= new Video();

        $mediable->value= $request->post('content');
        $mediable->save();

        $section= new ProposalSection();
        $section->name= $request->post('name');
        $section->proposal()->associate($proposal);
        $mediable->section()->save($section);

        return redirect()->route('proposal-section.index', $proposal->id)->with("status", "A section was added successfully.");
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
     * @param Proposal $proposal
     * @param ProposalSection $proposalSection
     * @return void
     */
    public function edit(Proposal $proposal, ProposalSection $proposalSection)
    {
        //
        $this->data['proposal']= $proposal;
        $this->data['type']= ProposalSection::$types[$proposalSection->mediable_type];
        $this->data['section']= $proposalSection;
        return view('sections.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Proposal $proposal
     * @param ProposalSection $section
     * @return void
     */
    public function update(Request $request, Proposal $proposal, ProposalSection $proposalSection)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $proposalSection->mediable->value= $request->post('content');

        $proposalSection->name= $request->post('name');
        $proposalSection->push();

        return redirect()->route('proposal-section.index', $proposal->id)->with("status", "The section was updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Proposal $proposal
     * @param ProposalSection $proposalSection
     * @return void
     * @throws Exception
     */
    public function destroy(Proposal $proposal, ProposalSection $proposalSection)
    {
        //
        $proposalSection->delete();
        return redirect()->back()->with("status", "A section was deleted successfully.");
    }
}
