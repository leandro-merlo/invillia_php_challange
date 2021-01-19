<?php

namespace App\Models;


/**
 * @OA\Schema(
 *     title="Item",
 *     description="Item model",
 *     @OA\Xml(
 *         name="Item"
 *     )
 * )
 */
class Item extends ValidationModel
{
    protected $fillable = [
        'title',
        'note',
        'quantity',
        'price',
        'ship_order_id'
    ];

    protected $rules = [
        'title' => 'required',
        'note' => 'required',
        'quantity' => 'required|integer',
        'price' => 'required|numeric',
        'ship_order_id' => 'required|exists:ship_orders,id'
    ];

    public function shipOrder()
    {
        return $this->belongsTo(ShipOrder::class);
    }

    /**
     * @OA\Property(
     *     title="id",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="title",
     *      description="Item title",
     *      example="Title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     title="quantity",
     *     description="Quantity",
     *     format="int",
     *     example=20
     * )
     *
     * @var integer
     */
    public $quantity;

    /**
     * @OA\Property(
     *     title="id",
     *     description="ID",
     *     format="float",
     *     example=754.34
     * )
     *
     * @var float
     */
    public $price;


    /**
     * @OA\Property(
     *     title="ship_order_id",
     *     description="Ship Order Id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $ship_order_id;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

}
