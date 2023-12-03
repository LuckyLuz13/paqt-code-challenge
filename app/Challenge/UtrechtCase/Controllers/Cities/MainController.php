<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers\Cities;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

final class MainController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
