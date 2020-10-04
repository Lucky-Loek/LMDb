<?php

namespace App\Actions;

class CalculateScreeningTime implements ActionInterface
{
    public function execute(array $data)
    {
        return array_reduce($data, function($previous, $current) {
            $cleanedRuntime = (int) str_replace(' min', '', $current['runtime']);
            $previous += $cleanedRuntime * 60;
            return $previous;
        });
    }
}
