<?php

namespace NW\WebService\Operations\Notifications\MessageBodies;

use NW\WebService\Exceptions\IncorrectInputDataException;

class ReturnStatus
{
    public const string COMPLETED = 'Completed';
    public const string PENDING   = 'Pending';
    public const string REJECTED  = 'Rejected';

    /**
     * @param int $id
     * @return string
     * @throws IncorrectInputDataException
     */
    public static function map(int $id): string
    {
        return match ($id) {
            0       => self::COMPLETED,
            1       => self::PENDING,
            2       => self::REJECTED,
            default => throw new IncorrectInputDataException(sprintf('Unknown return status id: %s', $id))
        };
    }
}

