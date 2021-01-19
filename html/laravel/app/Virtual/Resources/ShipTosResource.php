<?php

/**
 * @OA\Schema(
 *     title="ShipTosResource",
 *     description="Ship To (Destination) resource",
 *     @OA\Xml(
 *         name="ShipTosResource"
 *     )
 * )
 */
class ShipTosResource {
    /**
     * @OA\Property(
     *     title="List of Ship To (Destination) ",
     *     description="Data wrapper",
     *     @OA\Items(
     *        type="object",
     *        ref="#/components/schemas/ShipTo",
     *        @OA\Items()
     *     ),
     * )
     *
     * @var \App\Models\ShipTo[]
     */
    private $data;
}
