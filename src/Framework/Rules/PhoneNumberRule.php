<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class PhoneNumberRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return preg_match('/^\+?[0-9]{1,4}?[-. ]?\(?[0-9]{1,4}?\)?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/', $data[$field]) === 1;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This is not a valid phone number.";
    }
}
