<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Get all places
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Company::all();
        return response()->json($places);
    }

    /**
     * Get a specific place
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Company::findOrFail($id);
        return response()->json($place);
    }


    /**
     * Store a new place
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place = Company::create($request->all());
        return response()->json($place, 201);
    }

    /**
     * Update a well
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $well = Company::findOrFail($id);
        $well->update($request->all());
        return response()->json($well);
    }

    /**
     * Delete a well
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $well = Company::findOrFail($id);
        $well->delete();
        return response()->json(['message' => "Company with ID $id has been successfully deleted."], 200);
    }
}
