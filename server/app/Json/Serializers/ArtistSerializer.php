<?php

namespace App\Json\Serializers;

use App\Services\CountryService;

class ArtistSerializer
{
    public function __construct(
        private CountryService $countryService
    ) {
    }

    public function serialize(array $data): array
    {
        $links = [];

        if (isset($data['musicBrainzData']['relations'])) {
            foreach ($data['musicBrainzData']['relations'] as $relation) {
                switch ($relation['type']) {
                    // only utilize links for images, discogs, and spotify at this time
                    case 'image':
                        // need some trickery to actually get the image. wikimedia seems a little strange.
                        $contents = explode(':', $relation['url']['resource']);
                        $filename = $contents[2];
                        $imageUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/' . $filename . '?width=350';

                        $links[] = [
                            'type' => 'image',
                            'source' => $imageUrl
                        ];
                        break;
                    case 'discogs':
                        $links[] = [
                            'type' => 'discogs',
                            'source' => $relation['url']['resource']
                        ];
                        break;
                    case 'free streaming':
                        if (str_contains($relation['url']['resource'], 'spotify')) {
                            $links[] = [
                                'type' => 'spotify',
                                'source' => $relation['url']['resource']
                            ];
                        }
                        break;
                }
            }
        }

        if (isset($data['musicBrainzData']['country'])) {
            $country = $this->countryService->getCountryNameFromCountryCode($data['musicBrainzData']['country']);
        }

        if (isset($data['wikipediaData']['extract'])) {
            if (strlen(utf8_decode($data['wikipediaData']['extract'])) > 1300) {
                // if over 1500 characters, truncate it...we should link them to the wiki page... @todo if i forget!
                $wikiIntro = substr($data['wikipediaData']['extract'], 0, 1300) . ' ...continue reading at Wikipedia.';
            } else {
                $wikiIntro = $data['wikipediaData']['extract'];
            }
        }

        return [
            'id' => $data['musicBrainzData']['id'],
            'name' => $data['musicBrainzData']['name'],
            'country' => $country ?? '',
            'city' => $data['musicBrainzData']['begin-area']['name'] ?? '',
            'disambiguation' => $data['musicBrainzData']['disambiguation'] ?? '',
            'artistType' => $data['musicBrainzData']['type'],
            'links' => $links,
            'wikiTitle' => $data['wikipediaData']['title'] ?? '',
            'wikiIntro' => $wikiIntro ?? '',
            'lastFmUrl' => $data['lastFmData']['url'] ?? '',
            'lastFmListenerCount' => $data['lastFmData']['stats']['listeners'] ?? '',
            'lastFmPlayCount' => $data['lastFmData']['stats']['playcount'] ?? '',
            'onTour' => $data['lastFmData']['ontour'] === '1',
            'establishedYear' => $data['musicBrainzData']['life-span']['begin'] ?? null,
            'disbandedYear' => $data['musicBrainzData']['life-span']['end'] ?? 'present',
            'disbanded' => $data['musicBrainzData']['life-span']['ended'] ?? null,
        ];
    }

}
