<?php

namespace App\Models;

/**
 * @OA\Schema(
 *     title="ShipTo",
 *     description="Ship To (Destination) model",
 *     @OA\Xml(
 *         name="ShipTo"
 *     )
 * )
 */
class ShipTo extends ValidationModel
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'country'
    ];

    protected $rules = [
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required'
    ];

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
     *      title="name",
     *      description="Ship to name",
     *      example="Name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="address",
     *      description="Ship to address",
     *      example="Address"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      title="ciry",
     *      description="Ship to city",
     *      example="City"
     * )
     *
     * @var string
     */
    public $city;


    /**
     * @OA\Property(
     *      title="country",
     *      description="Ship to country",
     *      example="Country"
     * )
     *
     * @var string
     */
    public $country;

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
