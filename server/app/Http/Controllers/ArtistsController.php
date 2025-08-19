<?php

namespace App\Http\Controllers;

use App\Json\Serializers\ArtistSerializer;
use App\Json\Serializers\SearchArtistSerializer;
use App\Services\Explorer\ExplorerService;
use App\Services\Explorer\Model\GetArtistRequestFactory;
use App\Services\Explorer\Model\SearchArtistRequestFactory;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function __construct(
        private ArtistSerializer $artistSerializer,
        private ExplorerService $explorerService,
        private GetArtistRequestFactory $getArtistRequestFactory,
        private SearchArtistRequestFactory $searchArtistRequestFactory,
        private SearchArtistSerializer $searchArtistSerializer
    ) {
    }

    public function search(Request $request): array
    {
        $parameters = $this->searchArtistRequestFactory->parseRequest($request);
        $data = $this->explorerService->searchArtist($parameters);
        return $this->searchArtistSerializer->serialize($data);
    }

    public function get(Request $request): array
    {
        $parameters = $this->getArtistRequestFactory->parseRequest($request);
        $data = $this->explorerService->getArtistInfo($parameters);
        return $this->artistSerializer->serialize($data);
    }
}
