<?php

namespace Tests;

use jcobhams\NewsApi\NewsApi;

class NewsAPITest extends Test
{
    public function testGetArticles()
    {
        $key = $_ENV['NEWS_API_KEY'];
        $api = new NewsApi($key);

        $r = $api->getEverything('recommend trip');
        $this->assertSame('ok', $r->status);
        $article = $r->articles[0];
        var_dump($article);
    }
}