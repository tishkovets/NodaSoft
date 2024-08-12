<?php

namespace NW\WebService\Operations\Notifications\Messages\Email;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageBodies\MessageBody;
use NW\WebService\Operations\Notifications\MessageHandlers\Handlers\EmailMessageHandler;
use NW\WebService\Operations\Notifications\Messages\Message;

abstract class EmailMessage extends Message
{
    /**
     * @param string $recipient
     * @param MessageBody $messageBody
     * @param string $sender
     */
    public function __construct(
        protected string $recipient,
        protected MessageBody $messageBody,
        protected string $sender
    ) {
        parent::__construct($recipient, $messageBody);
    }

    /**
     * @return string
     */
    abstract public function getSubject(): string;

    /**
     * @return string
     */
    abstract public function getBody(): string;

    public static function type(): string
    {
        return 'email';
    }

    /**
     * @param Actor $actor
     * @return EmailMessageHandler
     */
    public function handler(Actor $actor): EmailMessageHandler
    {
        return new EmailMessageHandler($this, $actor);
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }
}
