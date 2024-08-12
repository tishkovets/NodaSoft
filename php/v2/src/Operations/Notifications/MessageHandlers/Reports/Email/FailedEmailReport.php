<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports\Email;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Email\EmailMessage;

final class FailedEmailReport extends EmailReport
{
    /**
     * @param Actor $actor
     * @param EmailMessage $message
     * @param array $error
     */
    public function __construct(Actor $actor, EmailMessage $message, protected array $error)
    {
        parent::__construct(Report::STATUS_FAILED, $actor, $message);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return parent::toArray() + ['error' => $this->error];
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }
}
