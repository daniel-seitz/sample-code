<?php

namespace App\Controllers;

abstract class ApiController extends Controller
{
    /**
     * Http Status Code
     *
     * @return json
     */
    protected $statusCode = 200;


    /**
     * Responds with a certain message
     *
     * @param string $message
     * @return json
     */
    public function respond($message)
    {
        return json_encode($message);
    }


    /**
     * Sets the Status Code
     *
     * @param number $statusCode
     * @return json
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }



    /**
     * Responds with an Error
     *
     * @param string $message
     * @param number $code
     * @return json
     */
    public function respondWithError($message, $code)
    {
        $error = [
            'status' => $message ?? 'error',
            'code' => $code
        ];

        return json_encode($message);
    }
}