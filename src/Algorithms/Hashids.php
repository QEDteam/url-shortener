<?php

namespace QEDTeam\UrlShortener\Algorithms;

use QEDTeam\UrlShortener\Url;
use Hashids\Hashids as Alg;

/**
 *
 */
class Hashids
{
    private $hashids;

    public function __construct()
    {
        $this->hashids = new Alg(config('url_shortener.algorithm_hash'));
    }

    public function createRecord($_url)
    {
        $url = Url::create(['original_url' => $_url, 'code' => '']);

        $url->code = $this->hashids->encode($url->id);
        $url->update();

        return $url;
    }

    public function getRecord($code)
    {
        $id = $this->hashids->decode($code);

        return Url::find($id);
    }
}