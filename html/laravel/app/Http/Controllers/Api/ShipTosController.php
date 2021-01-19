<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShipTo;
use Illuminate\Http\Request;


/** @OA\Tag(
 *     name="Ship To (Destination)",
 *     description="API Endpoints of Ship To"
 * )
 */
class ShipTosController extends Controller
{


     /**
     * @OA\Get(
     *      path="/shiptos",
     *      operationId="getShipTosList",
     *      tags={"Ship To (Destination)"},
     *      summary="Get list of Ship To (Destinations)",
     *      description="Returns list of all Ship To (Destinations)",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ShipTosResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        return response()->json(ShipTo::all());
    }

    /**
     * @OA\Get(
     *      path="/shiptos/{id}",
     *      operationId="findShipToById",
     *      tags={"Ship To (Destination)"},
     *      summary="Find a destination by id",
     *      description="Finds a destination from a given id",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ShipTo")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Ship To id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function findById($id) {
        if (!ShipTo::where('id', '=', $id)->exists()) {
            return response([], 400);
        }
        return response()->json(ShipTo::find($id));
    }
}
