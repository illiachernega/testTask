<?php

namespace Http\External;

use GuzzleHttp\Client;

readonly class BinController
{

    //it's better to store this type info inside .env file, or inside a wrapper that actually processes the call
    private const string BIN_URL = 'https://lookup.binlist.net/';

    public function __construct(
        private readonly Client $client
    ){}

    public function getByBin(string $bin): string
    {
        $response = $this->client->get(self::BIN_URL . $bin);

        if ($content = $response->getBody()->getContents()) {

            $countryCode = json_decode($content['country']['alpha2']);

            //before accessing $countryCode: $content should be sent to mapper, so we could apply our business namings for external response

            return $countryCode;
        }

        throw new \ErrorException('External service is not available');
    }
}
