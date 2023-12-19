<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
//use Illuminate\Support\Facades\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Formation::where('archive', false)->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

       // dd($request);
        $request->validate([
            'nom' => 'required',
        ]);

        $formation = new Formation([
            'nom' => $request->input('nom'),
        ]);

        $formation->save();
        return response()->json(['success', 'formation ajoutée']);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        return response()->json($formation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update( Request $request, Formation $formation)
    // {
    //     $request->validated($request->all());
    //     $formation->nom = $request->input('nom');
    //     $formation->status = $request->input('status');
    //     $formation->update();

    //     return response()->json($formation);
    // }


    public function update(Request $request, Formation $formation)
{
    $request->validate([
        'nom' => 'required',
        'status' => 'required',
    ]);

    $formation->update([
        'nom' => $request->input('nom'),
        'status' => $request->input('status'),
    ]);

    return response()->json($formation);
} 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $formation->archive = true;
        $formation->update();

        return response()->json($formation);
    }
}
