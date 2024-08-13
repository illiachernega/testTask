<?php

namespace Mappers;

class ExternalMapper
{

    //Actual data is file_get_contents($argv[1]) = $data | I'll assume that this should be a resource
    public static function mapToArray(string $fileName): SpecificDataType|array
    {
        $rows = explode("\n", file_get_contents($fileName));

        $mappedData = [];
        foreach ($rows as $row) {
            $fields = explode(",", $row);
            if (count($fields) < 3) {
                throw new \Exception('Data is invalid');
            }

            $bin = trim(explode(':', $fields[0])[1], '"');
            $amount = trim(explode(':', $fields[1])[1], '"');
            $currency = trim(explode(':', $fields[2])[1], '"}');

            $mappedData[] = [
                'bin' => $bin,
                'amount' => $amount,
                'currency' => $currency
            ];
        }

        return $mappedData;
    }
}
