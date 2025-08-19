<?php

namespace App\Libraries\Musicbrainz;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Docs: https://musicbrainz.org/doc/MusicBrainz_API
 */
class MusicBrainzApi
{
    private string $baseUrl;
    public const LIMIT = 50;

    public const ARTIST_URL = '/artist';
    public const RELEASE_GROUP_URL = '/release-group';

    public function __construct()
    {
        $this->baseUrl = getenv('MUSICBRAINZ_API_BASE_URL');
    }

    public function searchArtist(string $searchTerm): mixed
    {
        try {
            $response = Http::withHeaders($this->setDefaultHeaders())->get(
                $this->baseUrl . self::ARTIST_URL
                . '?query=' . $searchTerm
                . '&limit=' . self::LIMIT
            );

            if ($response->status() != 200) {
                Log::error('Client returned a non-200 status: Status Code: ' . $response->status());
                return false;
            }

            $responseContent = $response->json();
            if (isset($responseContent['artists'])) {
                return $responseContent;
            }

            return false;

        } catch (HttpResponseException $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            $content = $exception->getResponse()->getContent();
            throw $exception;
        }
    }

    public function getArtistInfo(string $artistId): mixed
    {
        try {
            $response = Http::withHeaders($this->setDefaultHeaders())->get(
                $this->baseUrl . self::ARTIST_URL
                . '/' . $artistId
                . '?inc=url-rels' // this ensures we get relevant URLs to third party services (spotify, images, etc)
                . '&fmt=json' // sometimes setting the 'Accept' => 'application/json' header doesn't always ensure json is returned
            );

            if ($response->status() != 200) {
                Log::error('Client returned a non-200 status: Status Code: ' . $response->status());
                return false;
            }

            $responseContent = $response->json();

            if (isset($responseContent['error'])) {
                Log::error('An error occurred getting info for artist ID: " ' . $artistId . ' ". Error code: ' . $responseContent['error']);
                return false;
            }

            return $responseContent;

        } catch (HttpResponseException $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            $content = $exception->getResponse()->getContent();
            throw $exception;
        }
    }

    /**
     * @param $searchTerm
     * @return mixed
     */
    public function searchReleaseGroup($searchTerm): mixed
    {
        try {
            $response = Http::withHeaders($this->setDefaultHeaders())->get(
                $this->baseUrl . self::RELEASE_GROUP_URL
                . '?query=' . $searchTerm
                . '&limit=' . self::LIMIT
            );

            if ($response->status() != 200) {
                Log::error('Client returned a non-200 status: Status Code: ' . $response->status());
                return false;
            }

            $responseContent = $response->json();

            if (isset($responseContent['release-groups'])) {
                return $responseContent['release-groups'];
            }

            return false;

        } catch (HttpResponseException $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            $content = $exception->getResponse()->getContent();
            throw $exception;
        }
    }

    /**
     * @param string $releaseGroupId
     * @return mixed
     */
    public function getReleaseGroup(string $releaseGroupId): mixed
    {
        try {
            $response = Http::withHeaders($this->setDefaultHeaders())->get(
                $this->baseUrl . self::RELEASE_GROUP_URL
                . '/' . $releaseGroupId
                . '?inc=releases+artist-credits'
            );

            if ($response->status() != 200) {
                Log::error('Client returned a non-200 status: Status Code: ' . $response->status());
                return false;
            }

            $responseContent = $response->json();

            if (isset($responseContent['error'])) {
                return false;
            }

            return $responseContent;

        } catch (HttpResponseException $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            $content = $exception->getResponse()->getContent();
            throw $exception;
        }
    }

    private function setDefaultHeaders(): array
    {
        return [
            'User-Agent' => getenv('MUSICBRAINZ_API_USER_AGENT'), // musicbrainz requires a meaningful User-Agent string with each request. Requests may be blocked without it.
            'Accept' => 'application/json' // XML is returned by default
        ];
    }
}
