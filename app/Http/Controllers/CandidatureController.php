<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Candidature::where('archive', false)->get());
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
    public function store($id_formation)
    {
        $candidature = new Candidature();
        $candidature->id_formation = $id_formation;
        $candidature->id_user = Auth::user()->id;
        $candidature->save();

        return response()->json($candidature);
    }

  
    public function validercandidature(Candidature $candidature)
    {
        $candidature->validation = 'valide';
        $candidature->update();

        return response()->json($candidature);
    }

    public function refusercandidature(Candidature $candidature)
    {
        $candidature->validation = 'non_valide';
        $candidature->update();

        return response()->json($candidature);
    }

    public function listCandidatureValider()
    {
        return response()->json(Candidature::where('validation','valide' && 'archive', false )->get());
    }

    public function listCandidatureNonValider()
    {
        return response()->json(Candidature::where('validation','non_valide')->get());
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidatureRequest $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
}
