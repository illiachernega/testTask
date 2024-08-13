<?php

namespace API;

use Http\External\BinController;

class BinService
{

    //!!! This is not a mistake, we should understand that we should not make guzzle or curl requests straightly inside the service:
    /**
     * this is bad:
     * $client = (new GuzzleClient())->get('url') ... process(client)
     */

    //instead we should use a separated class that will be making requests to external API with all needed validation rules, so other service would know nothing about external resources


    //Actually, there are some nuances with architecture in overall -- I can use Currency library to make proper calculations, make common Class with ValueObjects like bin, currency and amount, but I think next time :)

    public function __construct(
        private readonly BinController $controller
    ){}

    public function getBinResults(string $bin): string
    {
        return $this->controller->getByBin($bin);
    }

    public function store(string $content): void
    {
        //save content to local storage | mock
        //to control date that is received from another source I decided to store rates on local storage rather than in DB
        //I do understand that it's simply receiving data through a request without any need to store
    }
}
