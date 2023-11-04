<?php

namespace Tests\TravelTaipei;

use AiSocial\TravelTaipei\Event;
use AiSocial\TravelTaipei\Events;
use Tests\Test;

class EventsTest extends Test
{
    public function testLoad()
    {
        $events = new Events();

        $es = $events->load('2023-11-04', '2023-11-04');

        echo $es[0]->getDescription();

        $this->assertInstanceOf(Event::class, $es[0]);
    }
}