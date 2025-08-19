<?php

namespace App\Http\Controllers;

use App\Services\Explorer\ExplorerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LastFmController extends Controller
{
    public function __construct(
        private ExplorerService $explorerService
    ) {
    }

    public function test(Request $request)
    {
        return new Response();
    }
}
