<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0", 
 *      title="OpenApi Goodmeal documentation",
 *      description="Swagger OpenApi documentation",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response(int $code, string $message, $response, array $headers = [])
    {
        return response()->json(['code' => $code, 'msg' => $message, 'response' => $response], $code, $headers);
    }
}
