<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class BlueskyShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No bsky.app parameter url defined';
        }

        if (str_contains($url, 'bsky.app') === false && str_contains($url, 'bsky.app') === false) {
            return 'No bsky.app URL defined';
        }

        $html = self::getOembed($url) ?? null;

        if (!isset($html)) {
            return 'Cannot get bsky.app oEmbed';
        }

        return view('shortcode-plus::bluesky', compact('html'))->render();
    }

    /**
     * Get oEmbed data from Twitter
     * Note: Twitter sometimes returns 404 for valid URLs, so we retry a few times
     *
     * @throws GuzzleException
     */
    private static function getOembed(string $url): ?string
    {
        $maxAttempts = 3;
        $attempt = 0;
        $response = null;

        while ($attempt < $maxAttempts && $response === null) {
            try {
                $client = new Client;
                $res = $client->request('GET', 'https://embed.bsky.app/oembed', [
                    'query' => [
                        'url' => $url,
                    ],
                ]);

                if ($res->getStatusCode() == 200) {
                    $response = $res->getBody()->getContents();
                } else {
                    usleep(100000);
                    $attempt++;
                }
            } catch (RequestException $e) {
                usleep(100000);
                $attempt++;
            }
        }

        if ($response === null) {
            return null;
        }

        $data = json_decode($response, true);

        return $data['html'] ?? null;
    }
}
