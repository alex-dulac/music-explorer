<?php

namespace App\Libraries\LastFm;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Docs: https://www.last.fm/api
 */
class LastFmApi
{
    private string $baseUrl;
    private string $apiKey;

    public const GET_ARTIST_URL = '/?method=artist.getinfo&format=json';
    public const AUTH_URL = '/?method=artist.getinfo&format=json';

    public function __construct()
    {
        $this->baseUrl = getenv('LASTFM_API_BASE_URL');
        $this->apiKey = getenv('LASTFM_API_KEY');
    }

    public function getArtistInfo(string $artistName): mixed
    {
        try {
            $response = Http::get(
                $this->baseUrl . self::GET_ARTIST_URL
                . '&api_key=' . $this->apiKey
                . '&artist=' . $artistName
            );

            if ($response->status() != 200) {
                Log::error('Client returned a non-200 status: Status Code: ' . $response->status());
                return false;
            }

            $responseContent = $response->json();

            if (isset($responseContent['error'])) {
                Log::error('An error occurred getting info for artist name: " ' . $artistName . ' ". Error code: ' . $responseContent['error']);
                return false;
            }

            return $responseContent['artist'];

        } catch (HttpResponseException $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            $content = $exception->getResponse()->getContent();
            throw $exception;
        }
    }

    public function authorize(): mixed
    {
        try {
            $response = Http::get();

            if ($response->status() != 200) {
                Log::error('Client returned a non-200 status: Status Code: ' . $response->status());
                return false;
            }

            $responseContent = $response->json();

            if (isset($responseContent['error'])) {
                Log::error('An error occurred getting info for artist name: " ' . $artistName . ' ". Error code: ' . $responseContent['error']);
                return false;
            }

            return $responseContent['artist'];

        } catch (HttpResponseException $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            $content = $exception->getResponse()->getContent();
            throw $exception;
        }
    }
}
