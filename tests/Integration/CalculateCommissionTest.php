<?php

namespace Tests\Integration;

use API\BinService;
use API\RateService;
use App\Console\Commands\CalculateCommission;
use External\RateController;
use GuzzleHttp\Client;
use Http\External\BinController;
use Tests\TestCase;
use Validators\EuCountryValidator;

class CalculateCommissionTest extends TestCase
{
    public function __setUp()
    {
        //prepare mock data, testing environment, so we would not charge real external API (if needed)
    }


    //make on integration test for making sure that our systems work properly in different test cases from start to end
    public function testCalculateCommissionSuccess()
    {
        //not sure that we should mock our services because of environment and too strong dependencies nesting
        $rateControllerMock = $this->mock(RateController::class)->expects($this->once())->withArgs()->andReturn('');
        $binControllerMock = $this->mock(BinController::class)->expects($this->once())->withArgs()->andReturn('');
        $guzzleClient = (new Client());

        $command = (new CalculateCommission(
            (new BinService((new BinController($guzzleClient)))),
            (new RateService(new RateController($guzzleClient)))
        ));

        $actual = $command->handle();

        $this->assertSame($mockDate, $actual);
    }

    public function testIsEu() {
        $this->assertEquals(true, EuCountryValidator::checkIsEu('AT'));
        $this->assertEquals(true, EuCountryValidator::checkIsEu('FR'));
        $this->assertEquals(true, EuCountryValidator::checkIsEu('IT'));

        $this->assertEquals(false, EuCountryValidator::checkIsEu('US'));
        $this->assertEquals(false, EuCountryValidator::checkIsEu('CA'));
        $this->assertEquals(false, EuCountryValidator::checkIsEu('JP'));
    }
}
