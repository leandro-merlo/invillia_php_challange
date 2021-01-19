<?php


/**
 * @OA\Schema(
 *     title="Auth",
 *     description="Authentication Response",
 *     @OA\Xml(
 *         name="Auth"
 *     )
 * )
 */
class Auth {

    /**
     * @OA\Property(
     *      title="access_token",
     *      description="Access Token",
     *      example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9pbnZpbGxpYS5uZXRcL2FwaVwvdjFcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjEwOTg4NzcxLCJleHAiOjE2MTA5OTIzNzEsIm5iZiI6MTYxMDk4ODc3MSwianRpIjoiRmttOGJqUjU4NHhGWWZ3SSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.vHxamSZo8hY3dmubYlpXM5Wf04eNqdXYQ6uzBmu4TVQ"
     * )
     *
     * @var string
     */
    public $access_token;

    /**
     * @OA\Property(
     *      title="token_type",
     *      description="Token type",
     *      example="bearer"
     * )
     *
     * @var string
     */
    public $token_type;

    /**
     * @OA\Property(
     *     title="expires_in",
     *     description="Expiration time",
     *     format="int",
     *     example=3600
     * )
     *
     * @var integer
     */
    public $expires_in;
}
