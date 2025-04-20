<?php

declare(strict_types=1);


namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class DateShouldNotBeFutureRule implements RuleInterface
{
    public function validate(array $data, string  $field, array $params): bool
    {
        return isset($data[$field]) && strtotime($data[$field]) <= time();
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Date should not be in the future.";
    }
}
