<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use Illuminate\Support\Facades\Http;

class TmdbShortcode
{
    public function register($shortcode): string
    {
        $id = $shortcode->id ?? null;
        $type = match ($shortcode->type) {
            'movie' => 'movie',
            'tv' => 'tv',
            default => null,
        };

        if (! $id) {
            return 'Please provide a valid id';
        }

        if (! $type) {
            return 'Please provide a valid type (movie or tv)';
        }

        $data = $this->getTmdbDataFromApi($type, $id);

        return view('shortcode-plus::tmdb', compact('data'))->render();

    }

    /**
     * Get data from TMDB API
     */
    public function getTmdbDataFromApi(string $type, $id): mixed
    {
        $tmdbApiVersion = config('shortcode-plus.tmdb.api_version');
        $tmdbApiKey = config('shortcode-plus.tmdb.api_key');

        $response = Http::withHeaders([
            'Authorization' => "Bearer $tmdbApiKey",
            'accept' => 'application/json',
        ])
            ->acceptJson()
            ->get("https://api.themoviedb.org/$tmdbApiVersion/$type/$id");

        if ($response->failed()) {
            throw new \Exception('Error while fetching data from TMDB API');
        }

        return json_decode($response->body());
    }
}
