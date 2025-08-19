<?php

namespace App\Services\Explorer;

use App\Libraries\LastFm\LastFmApi;
use App\Libraries\Wikipedia\WikipediaApi;
use App\Libraries\Musicbrainz\MusicBrainzApi;
use App\Services\Explorer\Model\GetReleaseGroupRequest;
use App\Services\Explorer\Model\SearchReleaseGroupRequest;
use App\Services\Explorer\Model\GetArtistRequest;
use App\Services\Explorer\Model\SearchArtistRequest;

class ExplorerService
{
    public function __construct(
        private MusicBrainzApi $musicBrainzApi,
        private WikipediaApi $wikipediaApi,
        private LastFmApi $lastFmApi
    ) {
    }

    public function searchArtist(SearchArtistRequest $request)
    {
        $searchTerm = $request->getSearchTerm();
        return $this->musicBrainzApi->searchArtist($searchTerm);
    }

    public function getArtistInfo(GetArtistRequest $request)
    {
        $artistData = [];
        $artistId = $request->getArtistId();
        $artistData['musicBrainzData'] = $this->musicBrainzApi->getArtistInfo($artistId);

        $artistName = str_replace('-', '%2D', $artistData['musicBrainzData']['name']);
        $artistData['wikipediaData'] = $this->wikipediaApi->extractWikiIntro($artistName);
        $artistData['lastFmData'] = $this->lastFmApi->getArtistInfo($artistName);
        return $artistData;
    }

    public function searchReleaseGroup(SearchReleaseGroupRequest $request)
    {
        $searchTerm = $request->getSearchTerm();
        return $this->musicBrainzApi->searchReleaseGroup($searchTerm);
    }

    public function getReleaseGroup(GetReleaseGroupRequest $request)
    {
        $releaseGroupId = $request->getReleaseGroupId();
        return $this->musicBrainzApi->getReleaseGroup($releaseGroupId);
    }
}
