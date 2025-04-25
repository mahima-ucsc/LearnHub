<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class StartTimeEndTimeCompareRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $field1 = $field;
        $field2 = $params[0];

        $endTime = $data[$field1];
        $startTime = $data[$field2];

        if (!empty($startTime) && !empty($endTime)) {
            // Convert times to comparable format
            $startSeconds = $this->convertTimeToSeconds($startTime);
            $endSeconds = $this->convertTimeToSeconds($endTime);

            if ($startSeconds !== false && $endSeconds !== false && $endSeconds <= $startSeconds) {
                return false;
            }
        }
        return true;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "End time must be after start time";
    }

    private function convertTimeToSeconds(string $time): int|false
    {
        // Try to parse the time using strtotime
        $timestamp = strtotime("today " . $time);

        if ($timestamp === false) {
            return false;
        }

        // Extract just the time portion (seconds since midnight)
        return (int) date('H', $timestamp) * 3600 +
            (int) date('i', $timestamp) * 60 +
            (int) date('s', $timestamp);
    }
}
