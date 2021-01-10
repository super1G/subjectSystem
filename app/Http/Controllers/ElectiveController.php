<?php

namespace App\Http\Controllers;

use App\Models\Elective;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class ElectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $elective=Elective::with('Student')->with('Curriculum')->get();
        return response(['data'=>$elective],Response::HTTP_OK);
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
        //
        $elective=Elective::create($request->all());
        $elective=$elective->refresh();
        return response(['data'=>$elective],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Elective  $elective
     * @return \Illuminate\Http\Response
     */
    public function show(Elective $elective)
    {
        //
        $elective=Elective::with('Student')->with('Curriculum')->find($elective['id']);
        return response(['data'=>$elective],Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Elective  $elective
     * @return \Illuminate\Http\Response
     */
    public function edit(Elective $elective)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Elective  $elective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Elective $elective)
    {
        //
        $elective->update($request->all());
        return response($elective,Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Elective  $elective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Elective $elective)
    {
        //
        $elective->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
