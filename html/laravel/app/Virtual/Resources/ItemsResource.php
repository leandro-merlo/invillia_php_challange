<?php

/**
 * @OA\Schema(
 *     title="ItemsResource",
 *     description="Items resource",
 *     @OA\Xml(
 *         name="ItemsResource"
 *     )
 * )
 */
class ItemsResource {
    /**
     * @OA\Property(
     *     title="List of items",
     *     description="Data wrapper",
     *     @OA\Items(
     *        type="object",
     *        ref="#/components/schemas/Item",
     *        @OA\Items()
     *     ),
     * )
     *
     * @var \App\Models\Item[]
     */
    private $data;
}
