<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MatchRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $field1 = $field;
        $field2 = $params[0];

        return $data[$field1] === $data[$field2];
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Does not match the {$params[0]} field.";
    }
}
