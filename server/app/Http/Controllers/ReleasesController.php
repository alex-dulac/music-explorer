<?php

namespace App\Http\Controllers;

use App\Json\Serializers\SearchReleaseGroupSerializer;
use App\Services\Explorer\ExplorerService;
use App\Services\Explorer\Model\GetReleaseGroupRequestFactory;
use App\Services\Explorer\Model\SearchReleaseGroupRequestFactory;
use Illuminate\Http\Request;

class ReleasesController extends Controller
{
    public function __construct(
        private ExplorerService $explorerService,
        private GetReleaseGroupRequestFactory $getReleaseGroupRequestFactory,
        private SearchReleaseGroupRequestFactory $searchReleaseGroupRequestFactory,
        private SearchReleaseGroupSerializer $searchReleaseGroupSerializer
    ) {
    }

    public function searchReleaseGroup(Request $request)
    {
        $parameters = $this->searchReleaseGroupRequestFactory->parseRequest($request);
        $data = $this->explorerService->searchReleaseGroup($parameters);
        return $this->searchReleaseGroupSerializer->serialize($data);
    }

    public function getReleaseGroup(Request $request)
    {
        $parameters = $this->getReleaseGroupRequestFactory->parseRequest($request);
        return $this->explorerService->getReleaseGroup($parameters);
    }
}
