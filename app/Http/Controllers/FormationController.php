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
 * @OA\Get(
 *     path="/listFormation",
 *     tags={"Formations"},
 *     summary="Liste des formations",
 *     description="Récupère la liste des formations non archivées.",
 *     @OA\Response(
 *         response=200,
 *         description="Liste des formations récupérée avec succès",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Formation")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Non autorisé"
 *     ),
 *     security={}
 * )
 */
public function index()
{
    return response()->json(Formation::where('archive', false)->get());
}

 /**
     * @OA\Post(
     *     path="/ajoutFormation",
     *     tags={"Formations"},
     *     summary="Ajouter une formation",
     *     description="Ajoute une nouvelle formation.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom"},
     *             @OA\Property(property="nom", type="string", example="Nom de la formation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Formation ajoutée avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Formation ajoutée")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Non authentifié"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Non autorisé"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function create(Request $request)
    {

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
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        return response()->json($formation);
    }
     /**
 * @OA\Post(
 * path="/updateFormation/{formation}",
 *summary="cette route permet de modifier une formation",
 *@OA\Parameter(
*name="formation",
*in="path",
*required=true,
*description="formation correspond à l'id de la formation qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */

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
