<?php

namespace AiSocial\TravelTaipei;

use GuzzleHttp\Client;

class Events
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function load(string $startDate, string $endDate)
    {
        $json = $this->request($startDate, $endDate);

        return $this->convert($json);
    }

    protected function request(string $startDate, string $endDate, int $page = 1): string
    {
        $url = 'https://www.travel.taipei/open-api/zh-tw/Events/Activity';
        $response = $this->client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'begin' => $startDate,
                'end' => $endDate,
                'page' => $page,
            ],
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param string $json
     * @return Event[]
     */
    protected function convert(string $json): array
    {
        $obj = json_decode($json);

        return array_map(function ($row) {
            $event = new Event();

            $event->setTitle($row->title);
            $event->setDescription($row->description);
            $event->setStartAt($row->begin);
            $event->setEndAt($row->end);
            $event->setUrl($row->url);

            return $event;
        }, $obj->data);
    }
}