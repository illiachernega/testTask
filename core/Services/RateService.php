<?php

namespace API;

use External\RateController;

class RateService
{
    public function __construct(
        private readonly RateController $controller
    ){}

    public function getRatesByCurrency(string $bin): string
    {
        return $this->controller->getRates($bin);
    }
}
