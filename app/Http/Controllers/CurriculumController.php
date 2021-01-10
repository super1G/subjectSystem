<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Teacher;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $curriculums =Curriculum::with('teacher')->get();
        return response(['data'=>$curriculums],Response::HTTP_OK);
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
        $curriculum =Curriculum::create($request->all());
        $curriculum =$curriculum->refresh();
        return response($curriculum,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function show(Curriculum $curriculum)
    {
        //
        //$curriculum=$curriculum->with('teacher');
        $curriculum =Curriculum::with('teacher')->find($curriculum['id']);
        //Teacher::find($curriculum['id'])->curriculum;
        return response(['data'=>$curriculum,'id'=>$curriculum['id']],Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function edit(Curriculum $curriculum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curriculum $curriculum)
    {
        //
        $curriculum->update($request->all());
        return response($curriculum,Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curriculum $curriculum)
    {
        //
        $curriculum->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
