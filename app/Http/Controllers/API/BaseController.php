<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'message' => $message,
            'success' => true,
            'data'    => $result
        ];

        return response()->json($response, 200);
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendCreateResponse($result, $message)
    {
    	$response = [
            'message' => $message,
            'success' => true,
            'data'    => $result
        ];

        return response()->json($response, 201);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'message' => $error,
            'success' => false
        ];


        // if(!empty($errorMessages)){
        //     $response['data'] = $errorMessages;
        // }


        return response()->json($response, $code);
    }
}
