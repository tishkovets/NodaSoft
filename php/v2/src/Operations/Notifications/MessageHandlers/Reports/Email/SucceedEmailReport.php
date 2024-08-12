<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports\Email;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Email\EmailMessage;

final class SucceedEmailReport extends EmailReport
{
    /**
     * @param Actor $actor
     * @param EmailMessage $message
     */
    public function __construct(Actor $actor, EmailMessage $message)
    {
        parent::__construct(Report::STATUS_SUCCEED, $actor, $message);
    }
}
