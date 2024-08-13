<?php

namespace App\Console\Commands;

use API\BinService;
use API\CommissionService;
use API\RateService;
use Illuminate\Console\Command;
use Mappers\ExternalMapper;
use Validators\EuCountryValidator;

class CalculateCommission extends Command
{
    protected $signature = 'app:calculate-commission';

    protected $description = 'Command description';

    public function __construct(
        private readonly BinService $binService,
        private readonly RateService $rateService
    ){}

    //More appropriate way to test the code is PHPUnit acceptance tests, but it is rather faster to do simply in this way
    public function handle(): float
    {
        /**
         * {"bin":"45717360","amount":"100.00","currency":"EUR"}
         * {"bin":"516793","amount":"50.00","currency":"USD"}
         * {"bin":"45417360","amount":"10000.00","currency":"JPY"}
         * {"bin":"41417360","amount":"130.00","currency":"USD"}
         * {"bin":"4745030","amount":"2000.00","currency":"GBP"}
         */

        //foreach (explode("\n", file_get_contents($argv[1])) as $row) -- it's better to prepare an argument for foreach and threw already mapped and cleared data, so there will be no errors and "if else"'s
        //assuming that we've already done file_get_contents() and "$row" already mapped like this:

        /**
         * $row = [
         * [
         *   "bin" => "45717360",
         *   "amount" => "100.00",
         *   "currency" => "EUR"
         * ]
         * ];
         */

        //No needs at all make more interfaces for behaviour of these services, SRP is good enough
        $mappedData = ExternalMapper::mapToArray('nameOfAFile');
        $bin = $this->binService->getBinResults($mappedData['bin']);
        $rate = $this->rateService->getRatesByCurrency($mappedData['currency']);

        $fixedAmount = CommissionService::calculateAmount($mappedData['amount'], $mappedData['currency'], $rate);

        if (EuCountryValidator::checkIsEu($bin)) {
            $feeAmount = 0.01;
        } else {
            $feeAmount = 0.02;
        }

        // code about could be easily rewrote to -- $fixedAmount * ($isEu === true ? 0.01 : 0.02);
        // but I think small if else make code more clear, especially when we're getting closer to real money calculations

        $commission = $fixedAmount * $feeAmount;


        //could be also round, actually just a library
        return ceil($commission * 100) / 100;
    }
}
