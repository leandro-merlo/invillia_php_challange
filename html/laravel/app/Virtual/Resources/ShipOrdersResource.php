<?php

/**
 * @OA\Schema(
 *     title="ShipOrdersResource",
 *     description="ShipOrders resource",
 *     @OA\Xml(
 *         name="ShipOrdersResource"
 *     )
 * )
 */
class ShipOrdersResource {
    /**
     * @OA\Property(
     *     title="List of Ship Ordersw",
     *     description="Data wrapper",
     *     @OA\Items(
     *        type="object",
     *        ref="#/components/schemas/ShipOrder",
     *        @OA\Items()
     *     ),
     * )
     *
     * @var \App\Models\ShipOrder[]
     */
    private $data;
}
