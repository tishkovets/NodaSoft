<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports\Sms;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Sms\SmsMessage;

final class SucceedSmsReport extends SmsReport
{
    /**
     * @param Actor $actor
     * @param SmsMessage $message
     */
    public function __construct(Actor $actor, SmsMessage $message)
    {
        parent::__construct(Report::STATUS_SUCCEED, $actor, $message);
    }
}
