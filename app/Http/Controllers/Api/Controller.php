<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'status'    => true,
            'message'   => $message
        ];

        if (!is_null($result)) {
            $response['data'] = $result;
        }

        return response($response, $code);
    }
    public function sendError($message, $data = null, $code = 404)
    {
        $res = [
            'status'    => false,
            'message'   => $message,
        ];
        if (!empty($data)) {
            $res['data'] = $data;
        }
        return response($res, $code);
    }
}
