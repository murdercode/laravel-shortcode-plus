<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class TwitterShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No X.com parameter url defined';
        }

        if (str_contains($url, 'twitter.com') === false && str_contains($url, 'x.com') === false) {
            return 'No X.com URL defined';
        }

        try {
            $html = self::getOembed($url);

            if (! $html) {
                return 'Cannot get X.com oEmbed';
            }

            return view('shortcode-plus::twitter', compact('html'))->render();
        } catch (\Exception $e) {
            // Return a consistent error message without the specific error details
            return 'Error fetching Twitter content';
        }
    }

    /**
     * Get oEmbed data from Twitter
     *
     * @return string|null HTML from Twitter oEmbed
     */
    private static function getOembed(string $url): ?string
    {
        try {
            $client = new Client([
                'timeout' => 5, // Overall timeout
                'connect_timeout' => 5, // Connection timeout specifically
                RequestOptions::READ_TIMEOUT => 5, // Read timeout
                'http_errors' => false, // Don't throw exceptions on 4xx/5xx responses
                'verify' => false, // This can help with TLS connection issues
            ]);

            $res = $client->request('GET', 'https://publish.twitter.com/oembed', [
                'query' => [
                    'url' => $url,
                    'omit_script' => 1,
                ],
            ]);

            if ($res->getStatusCode() != 200) {
                return null;
            }

            $response = $res->getBody()->getContents();
            $data = json_decode($response, true);

            return $data['html'] ?? null;

        } catch (RequestException|ConnectException|GuzzleException $e) {
            // Any exception means we can't get the oEmbed
            return null;
        }
    }
}
