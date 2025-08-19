<?php

namespace App\Services\Explorer\Model;

use Illuminate\Http\Request;

class GetReleaseGroupRequestFactory
{
    public function __construct() {}

    public function parseRequest(Request $request): GetReleaseGroupRequest
    {
        $releaseGroupId = $request->releaseGroupId;

        return new GetReleaseGroupRequest($releaseGroupId);
    }
}
