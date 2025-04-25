<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\MiddlewareInterface;
use Framework\Contracts\RuleInterface;

class StartDateEndDateCompareRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $field1 = $field;
        $field2 = $params[0];

        $endDate = $data[$field1];
        $startDate = $data[$field2];

        if (!empty($startDate) && !empty($endDate)) {
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            if ($startDate && $endDate && $endDate <= $startDate) {
                return false;
            }
        }
        return true;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "End date must be after start date";
    }
}
