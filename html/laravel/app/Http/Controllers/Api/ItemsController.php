<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;


/** @OA\Tag(
 *     name="Items",
 *     description="API Endpoints of Items"
 * )
 */
class ItemsController extends Controller
{

    /**
     * @OA\Get(
     *      path="/items",
     *      operationId="getItemsList",
     *      tags={"Items"},
     *      summary="Get list of items",
     *      description="Returns list of all items",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ItemsResource")
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
     *
     */
    public function index()
    {
        return response()->json(Item::all());
    }

    /**
     * @OA\Get(
     *      path="/items/{id}",
     *      operationId="findItemById",
     *      tags={"Items"},
     *      summary="Find an item by id",
     *      description="Finds an item from a given id",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Item")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Item id",
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
        if (!Item::where('id', '=', $id)->exists()) {
            return response([], 400);
        }
        return response()->json(Item::find($id));
    }
}
