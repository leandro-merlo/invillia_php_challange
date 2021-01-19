<?php

namespace App\Models;


/**
 * @OA\Schema(
 *     title="Person",
 *     description="Person model",
 *     @OA\Xml(
 *         name="Person"
 *     )
 * )
 */
class Person extends ValidationModel
{
    protected $fillable = [ 'id', 'name', 'phones' ];

    protected $rules = [
        'id' => 'unique:people,id|integer',
        'name' => 'required',
        'phones' => 'nullable'
    ];

    protected $casts = [
        'phones' => 'array'
    ];

    /**
     * @OA\Property(
     *     title="ID",
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
     *      title="Name",
     *      description="Name of the person",
     *      example="Jhon"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Phones",
     *      description="Person related phones",
     *      example="[1234567,8888888]",
     *      @OA\Items(
     *          type="string",
     *          @OA\Items()
     *      ),
     * )
     *
     * @var array
     */
    public $phones;

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
