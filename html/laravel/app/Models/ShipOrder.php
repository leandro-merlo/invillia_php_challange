<?php

namespace App\Models;

/**
 * @OA\Schema(
 *     title="ShipOrder",
 *     description="ShipOrder model",
 *     @OA\Xml(
 *         name="ShipOrder"
 *     )
 * )
 */
class ShipOrder extends ValidationModel
{
    protected $fillable = ['id', 'ship_to_id', 'person_id'];

    protected $rules = [
        'id' => 'unique:ship_orders,id|integer',
        'person_id' => 'required|exists:people,id',
        'ship_to_id' => 'required|exists:ship_tos,id',
    ];

    public function shipTo()
    {
        return $this->hasOne(ShipTo::class, 'id', 'ship_to_id');
    }

    public function person()
    {
        return $this->hasOne(Person::class, 'id','person_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
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
     *     title="person_id",
     *     description="Person Id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $person_id;

    /**
     * @OA\Property(
     *     title="ship_to_id",
     *     description="Ship To Id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $ship_to_id;

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
