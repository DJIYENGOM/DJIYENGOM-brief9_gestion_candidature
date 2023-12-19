<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use Illuminate\Support\Facades\Auth;
Use OpenApi\Annotations as OA ;

class CandidatureController extends Controller
{
  
         /**
 * @OA\Get(
 * path="/listCandidature",
 *summary="cette route permet de lister toutes les candidatures",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Candidature::where('archive', false)->get());
    }

  
       /**
 * @OA\Post(
 * path="'postuler/{id_formation}",
 *summary="cette route permet de postuler à une formation (id_formation)",
 *@OA\Parameter(
*name="id_formation",
*in="path",
*required=true,
*description="id_formation de la formation qu'on veut postuler",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function store($id_formation)
    {
        $candidature = new Candidature();
        $candidature->id_formation = $id_formation;
        $candidature->id_user = Auth::user()->id;
        $candidature->save();

        return response()->json($candidature);
    }

       /**
 * @OA\Post(
 * path="/validercandidature/{candidature}",
 *summary="cette route permet de valider une candidature (id_candidature)",
 *@OA\Parameter(
*name="candidature",
*in="path",
*required=true,
*description="candidature correspond à l'id du candidature qu'on veut valider",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function validercandidature(Candidature $candidature)
    {
        $candidature->validation = 'valide';
        $candidature->update();

        return response()->json($candidature);
    }


        /**
 * @OA\Post(
 * path="/refusercandidature/{candidature}",
 *summary="cette route permet de refuser une candidature (id_candidature)",
 *@OA\Parameter(
*name="candidature",
*in="path",
*required=true,
*description="candidature correspond à l'id du candidature qu'on veut refuser",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function refusercandidature(Candidature $candidature)
    {
        $candidature->validation = 'non_valide';
        $candidature->update();

        return response()->json($candidature);
    }

            /**
 * @OA\Get(
 * path="/listCandidatureValider",
 *summary="cette route permet de lister tous les candidatures qui sont validées",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function listCandidatureValider()
    {
        return response()->json(Candidature::where('validation','valide' && 'archive', false )->get());
    }

                /**
 * @OA\Get(
 * path="/listCandidatureNonValider",
 *summary="cette route permet de lister tous les candidatures qui sont refusées",

 *     @OA\Response(response="200", description="success",)
 * )
 */
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
