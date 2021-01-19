<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShipOrder;
use Illuminate\Http\Request;


/** @OA\Tag(
 *     name="Ship Orders",
 *     description="API Endpoints of Ship Orders"
 * )
 */
class ShipOrdersController extends Controller
{

     /**
     * @OA\Get(
     *      path="/shiporders",
     *      operationId="getShipOrdersList",
     *      tags={"Ship Orders"},
     *      summary="Get list of Ship Orders",
     *      description="Returns list of all Ship Orders",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ShipOrdersResource")
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
        return response()->json(ShipOrder::all());
    }

    /**
     * @OA\Get(
     *      path="/shiporders/{id}",
     *      operationId="findShipOrderById",
     *      tags={"Ship Orders"},
     *      summary="Find a Ship Order by id",
     *      description="Finds a Ship Order from a given id",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ShipOrder")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Ship Order id",
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
        if (!ShipOrder::where('id', '=', $id)->exists()) {
            return response([], 400);
        }
        return response()->json(ShipOrder::find($id));
    }

    /**
     * @OA\Get(
     *      path="/shiporders/{id}/shipto",
     *      operationId="findShipToByShipOrderId",
     *      tags={"Ship Orders"},
     *      summary="Find a Ship To (Destination) by Ship Order id",
     *      description="Finds a Ship To (Destination) from a given Ship Order id",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ShipTo")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Ship Order id",
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
    public function findShiptoByOrderId($id) {
        if (!ShipOrder::where('id', '=', $id)->exists()) {
            return response([], 400);
        }
        $shiporder = ShipOrder::find($id);
        return response()->json($shiporder->shipTo);
    }

    /**
     * @OA\Get(
     *      path="/shiporders/{id}/items",
     *      operationId="findItemsByShipOrderId",
     *      tags={"Ship Orders"},
     *      summary="Find Items by Ship Order id",
     *      description="Finds a Items from a given Ship Order id",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Item")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Ship Order id",
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
    public function findItemsByOrderId($id) {
        if (!ShipOrder::where('id', '=', $id)->exists()) {
            return response([], 400);
        }
        $shiporder = ShipOrder::find($id);
        return response()->json($shiporder->items);
    }
}
