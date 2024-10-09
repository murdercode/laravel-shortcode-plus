<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

class RedditShortcode
{
    public function register($shortcode): string
    {

        $url = $shortcode->url;

        //        <blockquote class="reddit-card" data-card-created="1596039116">    <a href="https://www.reddit.com/r/microsoft/comments/hg4uiq/microsoft_official_support_thread/">        Microsoft: Official Support Thread</a> from <a href="http://www.reddit.com/r/microsoft">r/microsoft    </a></blockquote><script async src="//embed.redditmedia.com/widgets/platform.js" charset="UTF-8"></script>
        return '<blockquote class="reddit-card" data-card-created="'.time().'"><a href="'.$url.'">'.$url.'</a></blockquote><script async src="//embed.redditmedia.com/widgets/platform.js" charset="UTF-8"></script>';
    }
}
