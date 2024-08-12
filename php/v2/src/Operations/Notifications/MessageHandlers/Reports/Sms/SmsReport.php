<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports\Sms;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Sms\SmsMessage;

abstract class SmsReport extends Report
{
    /**
     * @param string $status
     * @param Actor $actor
     * @param SmsMessage $message
     */
    public function __construct(string $status, Actor $actor, SmsMessage $message)
    {
        parent::__construct($status, $actor, $message);
    }
}
