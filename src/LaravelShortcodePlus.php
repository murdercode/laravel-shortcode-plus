<?php

namespace Murdercode\LaravelShortcodePlus;

use Illuminate\Contracts\View\View;

class LaravelShortcodePlus
{


    public static function source(string $source): static
    {
        return new static($source);
    }

    public function __construct(protected string $content = '')
    {
    }

    public function parseAll(): string
    {
        $this->content = $this->parseTwitterTag();
        $this->content = $this->parseYoutubeTag();
        return $this->content;
    }


    public function parseTwitterTag(): string
    {
        return preg_replace_callback(
            '/\[twitter url="(.*?)"]/',
            function ($matches) {
                curl_setopt_array($curl = curl_init(), [
                    CURLOPT_URL => "https://publish.twitter.com/oembed?url=$matches[1]",
                    CURLOPT_RETURNTRANSFER => true,
                ]);
                $response = curl_exec($curl);
                curl_close($curl);
                return json_decode($response)->html ?? 'No twitter URL defined';
            },
            $this->content
        );
    }

    public function parseYoutubeTag(): string
    {
        preg_match('/\[youtube url="(.*?)"]/', $this->content, $matches);
        $youtubeId = $matches[1] ?? null;
        if ($youtubeId) {
            $youtubeId = explode('v=', $youtubeId)[1];
            $youtubeId = explode('&', $youtubeId)[0];
            return view('shortcode-plus::components.youtube', ['video_id' => $youtubeId]);
        } else {
            return preg_replace(
                '/\[youtube]/',
                'No youtube URL defined',
                $this->content
            );
        }
    }

}
