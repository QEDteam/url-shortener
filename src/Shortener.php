<?php

namespace QEDTeam\UrlShortener;

use Webpatser\Uuid\Uuid;
use QEDTeam\UrlShortener\Url;

/**
 *
 */
class Shortener
{
    public function make($_url)
    {
        $code = $this->makeCode($_url);

        $shortUrl = config('app.url') . '/' . config('url_shortener.default_url_path') . '/' . $code;

        return $shortUrl;
    }

    public function makeCode($_url)
    {
        $url = new Url;

        $url->original_url = $_url;
        $url->code = Uuid::generate()->string;

        $url->save();

        return $url->code;
    }

    public function getUrl($code)
    {
        return Url::getByCode($code);
    }
}