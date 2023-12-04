<?php

declare(strict_types=1);

namespace App\Challenge\UtrechtCase\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CanListInterface
{
    public function list(Request $request): Collection;
}
