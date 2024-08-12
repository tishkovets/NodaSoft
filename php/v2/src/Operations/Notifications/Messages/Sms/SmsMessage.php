<?php

namespace NW\WebService\Operations\Notifications\Messages\Sms;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Handlers\SmsMessageHandler;
use NW\WebService\Operations\Notifications\Messages\Message;

abstract class SmsMessage extends Message
{
    /**
     * @return string
     */
    abstract public function getBody(): string;

    public static function type(): string
    {
        return 'sms';
    }

    /**
     * @param Actor $actor
     * @return SmsMessageHandler
     */
    public function handler(Actor $actor): SmsMessageHandler
    {
        return new SmsMessageHandler($this, $actor);
    }
}
