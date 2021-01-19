<?php

/**
 * @OA\Schema(
 *     title="PeopleResource",
 *     description="People resource",
 *     @OA\Xml(
 *         name="PeopleResource"
 *     )
 * )
 */
class PeopleResource {
    /**
     * @OA\Property(
     *     title="List of persons",
     *     description="Data wrapper",
     *     @OA\Items(
     *        type="object",
     *        ref="#/components/schemas/Person",
     *        @OA\Items()
     *     ),
     * )
     *
     * @var \App\Models\Person[]
     */
    private $data;
}
