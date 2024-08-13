<?php

use API\CommissionService;

class TestCommissionService extends \Tests\TestCase
{

    public function testCalculateAmountEur() {
        $this->assertEquals(100, CommissionService::calculateAmount(100, 'EUR', 0));
        $this->assertEquals(100, CommissionService::calculateAmount(100, 'EUR', 1.2));
    }

    public function testCalculateAmountDiffCurrency()
    {
        $this->assertEquals(50, CommissionService::calculateAmount(100, 'USD', 2));
        $this->assertEquals(200, CommissionService::calculateAmount(100, 'JPY', 0.5));
    }
}
