<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class SpotifyShortcode
{
    protected $spotify_embed_url = 'https://open.spotify.com/embed/';

    public function register($shortcode): string
    {

        $urlOrUri = $shortcode->url ?? $shortcode->uri ?? null;

        if (! isset($urlOrUri)) {
            return 'No url or uri Spotify provided';
        }

        $convertedUrl = $this->getEmbedUrl($urlOrUri);

        return view('shortcode-plus::spotify', compact('convertedUrl'))->render();

    }

    protected function getEmbedUrl(string $urlOrUri): string
    {
        $typeAndId = self::extractTypeAndId($urlOrUri);
        $type = $typeAndId[0];
        $id = $typeAndId[1];

        return $this->spotify_embed_url.$type.'/'.$id;
    }

    protected function extractTypeAndId(string $urlOrUri): array
    {

        if (str_contains($urlOrUri, 'spotify:')) {
            $uri = str_replace('spotify:', '', $urlOrUri);
            $parts = explode(':', $uri);
        } else {
            $url = str_replace('https://open.spotify.com/', '', $urlOrUri);
            $parts = explode('/', $url);
        }
        $type = $parts[0] ?? null;
        $id = $parts[1] ?? null;

        return [$type, $id];
    }
}
