<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetRedirectDataAction;
use App\Actions\GetRedirectDataRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    private $getRedirectDataAction;

    public function __construct(GetRedirectDataAction $getRedirectDataAction)
    {
        $this->getRedirectDataAction = $getRedirectDataAction;
    }

    public function redirect(Request $request, string $slug): RedirectResponse
    {
        return $this->getRedirectDataAction->execute(
            new GetRedirectDataRequest($request->ip(),
                $request->userAgent()), $slug
        );
    }
}