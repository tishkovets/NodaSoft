<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Handlers;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Report;
use NW\WebService\Operations\Notifications\Messages\Message;

abstract class MessageHandler
{
    /**
     * @param Message $message
     * @param Actor $actor
     */
    public function __construct(protected Message $message, protected Actor $actor)
    {
    }

    /**
     * @return Report
     */
    abstract public function handle(): Report;
}
