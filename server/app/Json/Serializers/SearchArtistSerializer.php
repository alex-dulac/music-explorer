<?php

namespace App\Json\Serializers;

use App\Services\CountryService;

class SearchArtistSerializer
{
    public function __construct(
        private CountryService $countryService
    ) {

    }

    public function serialize(array $searchResults)
    {
        if ($searchResults['count'] === 0) {
            return false;
        }

        $artists = [];

        foreach ($searchResults['artists'] as $searchResult) {
            $tags = [];
            if (isset($searchResult['tags'])) {
                foreach ($searchResult['tags'] as $tag) {
                    $tags[] = $tag['name'];
                }
            }

            if (isset($searchResult['country']) && isset($searchResult['life-span']['begin'])) {
                // it's not really worth showing if there is no country
                $country = $this->countryService->getCountryNameFromCountryCode($searchResult['country']);
                $artists[] = [
                    'id' => $searchResult['id'],
                    'name' => $searchResult['name'],
                    'country' => $country,
                    'establishedYear' => $searchResult['life-span']['begin'] ?? null,
                    'disbandedYear' => $searchResult['life-span']['ended'] ?? null,
                    'tags' => $tags
                ];
            }
        }

        return $artists;
    }

}
