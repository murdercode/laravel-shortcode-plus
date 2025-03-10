<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
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

            return $html;
        } catch (\Exception $e) {
            // For testing purposes, you might want to log the actual error
            // Log::error('Twitter error: ' . $e->getMessage());

            // Return a consistent error message without the specific error details
            return 'Error fetching Twitter content';
        }
    }

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

            $response = $client->get('https://publish.twitter.com/oembed', [
                'query' => [
                    'url' => $url,
                    'omit_script' => 1,
                ],
            ]);

            if ($response->getStatusCode() >= 400) {
                throw new \Exception('Twitter service returned error: '.$response->getStatusCode());
            }

            $body = json_decode($response->getBody()->getContents());

            return $body->html ?? null;

        } catch (ConnectException $e) {
            // Specific connection exceptions (like timeout)
            throw new \Exception('Unable to connect to Twitter service');
        } catch (GuzzleException $e) {
            // All other Guzzle exceptions (including cURL errors)
            throw new \Exception('Error communicating with Twitter service');
        } catch (\Exception $e) {
            // Catch any other exceptions that might occur
            throw new \Exception('Error accessing Twitter service');
        }
    }
}
