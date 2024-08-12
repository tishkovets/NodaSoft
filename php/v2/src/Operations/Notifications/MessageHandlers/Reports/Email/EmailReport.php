<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports\Email;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Email\EmailMessage;

abstract class EmailReport extends Report
{
    /**
     * @param string $status
     * @param Actor $actor
     * @param EmailMessage $message
     */
    public function __construct(string $status, Actor $actor, EmailMessage $message)
    {
        parent::__construct($status, $actor, $message);
    }
}
