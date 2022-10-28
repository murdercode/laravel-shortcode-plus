<?php

namespace Murdercode\LaravelShortcodePlus;

use Illuminate\Contracts\View\View;

class LaravelShortcodePlus
{

    public static function source(string $source): static
    {
        return new static($source);
    }

    public function __construct(protected string $content)
    {
    }

    public function parseAll(): string
    {
        return $this->parseTwitterTag();
    }

    public function parseTwitterTag(): string|null
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
                return json_decode($response)->html ?? 'No twitter defined';
            },
            $this->content
        );
    }

    public function parseYoutubeTag()
    {
        preg_match('/\[youtube url="(.*?)"]/', $this->content, $matches);
        $video_id = explode("?v=", $matches[1]);
        $video_id = $video_id[1];
        return view('shortcode-plus::youtube', ['video_id' => $video_id])->render();
    }

}
