<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Imports\PersonalDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $personalData = PersonalData::latest()->paginate(20);

        return view('personalData.index', compact('personalData'));
            //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('personalData.create');
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
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'telephone' => 'required'
        ]);

        Project::create($request->all());

        return redirect()->route('personalData.index')
            ->with('success', ' Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonalData  $personalData
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalData $personalData)
    {
        //
        return view('personalData.show', compact('personalData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalData  $personalData
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalData $personalData)
    {
        //
        return view('personalData.edit', compact('personalData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonalData  $personalData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalData $personalData)
    {
        //
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'telephone' => 'required'
        ]);

        Project::update($request->all());

        return redirect()->route('personalData.index')
            ->with('success', ' Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalData  $personalData
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalData $personalData)
    {
        //
        $personalData->delete();

        return redirect()->route('personalData.index')
            ->with('success', 'Data deleted successfully');
    }

    public function importPersonalData()
    {

        Excel::import(new PersonalDataImport, request()->file('file'));

        return back()->with('success', 'Data uploaded successfully.');
    }
}
