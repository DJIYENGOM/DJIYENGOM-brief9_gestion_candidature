<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
Use OpenApi\Annotations as OA ;


/**
 * @SWG\Info(title="endpoint", version="0.1")
 */
class Controller extends BaseController

{
    use AuthorizesRequests, ValidatesRequests;

}
