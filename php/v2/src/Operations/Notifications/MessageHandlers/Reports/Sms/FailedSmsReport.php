<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports\Sms;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Sms\SmsMessage;

final class FailedSmsReport extends SmsReport
{
    /**
     * @param Actor $actor
     * @param SmsMessage $message
     * @param array $error
     */
    public function __construct(Actor $actor, SmsMessage $message, protected array $error)
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
