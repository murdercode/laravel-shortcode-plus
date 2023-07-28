<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class ButtonShortcode
{
    public function register($shortcode): string
    {
        $link = $shortcode->link ?? '#';
        $label = $shortcode->label ?? 'Click here';
        $isSponsored = $this->isSponsored($link);

        $level = match ($shortcode->level) {
            'secondary' => 'secondary',
            default => 'primary',
        };

        return view('shortcode-plus::button', compact('link', 'label', 'level', 'isSponsored'))->render();
    }

    public function isSponsored($link): bool
    {
        $whitelistDomains = config('shortcode-plus.button.sponsored.whitelist') ?? [];

        if ($link === '#') {
            return false;
        }

        foreach ($whitelistDomains as $domain) {
            if (str_contains($link, $domain)) {
                return false;
            }
        }

        return true;

    }
}
