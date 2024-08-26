<?php

namespace App\Http\Controllers;

use App\Http\Requests\SummaryRequest;
use App\Models\Summary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('uploads.show', [
            'summary' => Summary::all()]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SummaryRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $summaries = new Summary();
        $summaries->name = $request->input('name');
        $summaries->biography = $request->input('biography');
        $summaries->address = $request->input('address');
        $summaries->phone = $request->input('phone');
        $summaries->email = $request->input('email');
        $summaries->save();

        dd($summaries);
        return Redirect::route('summaries.store')->with('status', 'summary-updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
