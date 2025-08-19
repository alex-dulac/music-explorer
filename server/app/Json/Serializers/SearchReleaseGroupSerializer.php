<?php

namespace App\Json\Serializers;

class SearchReleaseGroupSerializer
{
    public function serialize(array $searchResults)
    {
        $releaseGroups = [];

        foreach ($searchResults as $searchResult) {
            $tags = [];
            if (isset($searchResult['tags'])) {
                foreach ($searchResult['tags'] as $tag) {
                    $tags[] = $tag['name'];
                }
            }

            $artist = [];
            $artistCredit = current($searchResult['artist-credit']);
            $artist['artistName'] = $artistCredit['name'];
            $artist['artistId'] = $artistCredit['artist']['id'];

            $releases = [];
            if (isset($searchResult['releases'])) {
                foreach ($searchResult['releases'] as $release) {
                    $releases[] = [
                        'releaseId' => $release['id'],
                        'title' => $release['title'],
                        'status' => $release['status'] ?? ''
                    ];
                }
            }

            if (isset($searchResult['first-release-date'])) {
                // it's not really worth showing if there is no release date
                $releaseGroups[] = [
                    'releaseGroupId' => $searchResult['id'],
                    'title' => $searchResult['title'],
                    'releaseDate' => $searchResult['first-release-date'],
                    'type' => $searchResult['primary-type'] ?? '',
                    'artist' => $artist,
                    'releases' => $releases,
                    'tags' => $tags
                ];
            }
        }

        return $releaseGroups;
    }

}
