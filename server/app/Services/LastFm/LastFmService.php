<?php

namespace App\Services\Explorer;

use App\Libraries\LastFm\LastFmApi;

class LastFmService
{
    public function __construct(
        private LastFmApi $lastFmApi
    ) {
    }

    public function initLastFmConnection()
    {
        // this happens after the client stores a token and username... i think
    }
}
