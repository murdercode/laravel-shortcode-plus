<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        if (!$id) {
            return 'Please provide a valid id';
        }

        if (!$type) {
            return 'Please provide a valid type (movie or tv)';
        }

        $data = $this->getTmdbDataFromApi($type, $id);
        $moreLink = $this->generateMoreLink($type, $id);

        if (!$data || !$moreLink) {
            return '';
        }

        return view('shortcode-plus::tmdb', compact('data', 'moreLink', 'id', 'type'))->render();

    }

    /**
     * Get TMDB item
     */
    public function getTmdbData($type, $id)
    {
        return cache("laravel-shortcode-plus::tmdb.$type.$id", function () use ($type, $id) {
            return $this->getTmdbDataFromApi($type, $id);
        }, config('shortcode-plus.tmdb.cache_ttl'));
    }

    /**
     * Get data from TMDB API
     */
    public function getTmdbDataFromApi(string $type, $id): mixed
    {
        $tmdbApiVersion = config('shortcode-plus.tmdb.api_version');
        $tmdbApiKey = config('shortcode-plus.tmdb.api_key');
        $tmdbLanguage = config('shortcode-plus.tmdb.language');

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $tmdbApiKey",
                'accept' => 'application/json',
            ])
                ->acceptJson()
                ->get("https://api.themoviedb.org/$tmdbApiVersion/$type/$id?language=$tmdbLanguage");

            if ($response->failed()) {
                //            if(config('app.debug')) {
                //                throw new \Exception('Error while fetching data from TMDB API');
                //            }
                return null;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return '';
        }

        return json_decode($response->body());
    }

    /**
     * Generate More Link
     */
    public function generateMoreLink($type, $id): ?string
    {
        $moreLinkDomain = config('shortcode-plus.tmdb.more_link.domain');

        if (!$moreLinkDomain) {
            return null;
        }

        $moreLinkType = match ($type) {
            'movie' => config('shortcode-plus.tmdb.more_link.movie-prefix'),
            'tv' => config('shortcode-plus.tmdb.more_link.tv-prefix'),
            default => null,
        };

        if (!$moreLinkType) {
            return null;
        }

        return "$moreLinkDomain/$moreLinkType/$id";

    }
}
