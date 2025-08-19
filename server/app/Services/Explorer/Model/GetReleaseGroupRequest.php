<?php

namespace App\Services\Explorer\Model;

class GetReleaseGroupRequest
{
    private string $releaseGroupId;

    public function __construct($releaseGroupId)
    {
        $this->releaseGroupId = $releaseGroupId;
    }

    public function getReleaseGroupId(): string
    {
        return $this->releaseGroupId;
    }
}
