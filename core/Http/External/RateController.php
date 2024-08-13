<?php

namespace External;
use GuzzleHttp\Client;

readonly class RateController
{
    private const string RATES_URL = 'https://api.exchangeratesapi.io/latest';

    public function __construct(
        private readonly Client $client
    ){}

    public function getRates(string $currency): string
    {
        $response = $this->client->get(self::RATES_URL);

        if ($content = $response->getBody()->getContents()) {

            $rate = json_decode($content['rates'][$currency]);

            // same goes for rates -- they should be mapped

            return $rate ?? 0;
        }

        throw new \ErrorException('External service is not available');
    }
}
