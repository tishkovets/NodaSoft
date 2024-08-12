<?php

namespace NW\WebService\Operations\Notifications\Messages;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageBodies\MessageBody;
use NW\WebService\Operations\Notifications\MessageHandlers\Handlers\MessageHandler;

abstract class Message
{
    /**
     * @param string $recipient
     * @param MessageBody $messageBody
     */
    public function __construct(
        protected string $recipient,
        protected MessageBody $messageBody
    ) {
    }

    /**
     * @param Actor $actor
     * @return MessageHandler
     */
    abstract public function handler(Actor $actor): MessageHandler;

    /**
     * @return string
     */
    abstract public static function type(): string;

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * @return MessageBody
     */
    public function getMessageBody(): MessageBody
    {
        return $this->messageBody;
    }
}
