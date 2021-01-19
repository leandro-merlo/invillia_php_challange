<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;


/** @OA\Tag(
 *     name="People",
 *     description="API Endpoints of People"
 * )
 */
class PeopleController extends Controller
{

    /**
     * @OA\Get(
     *      path="/people",
     *      operationId="getPeopleList",
     *      tags={"People"},
     *      summary="Get list of person",
     *      description="Returns list of all person",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PeopleResource")
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
        return response()->json(Person::all());
    }

    /**
     * @OA\Get(
     *      path="/people/{id}",
     *      operationId="findPersonById",
     *      tags={"People"},
     *      summary="Find a person by id",
     *      description="Finds a person from a given id",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Person")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Person id",
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
        if (!Person::where('id', '=', $id)->exists()) {
            return response([], 400);
        }
        return response()->json(Person::find($id));
    }
}
