<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\Messages\Message;

abstract class Report implements ReportInterface
{
    public const string STATUS_SUCCEED = 'succeed';
    public const string STATUS_FAILED  = 'failed';

    /**
     * @param string $status
     * @param Actor $actor
     * @param Message $message
     */
    public function __construct(protected string $status, protected Actor $actor, protected Message $message)
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status'  => $this->getStatus(),
            'actor'   => [
                'id'   => $this->getActor()->getId(),
                'name' => $this->getActor()->getName(),
                'role' => $this->getActor()::role(),
            ],
            'message' => [
                'type'      => $this->message::type(),
                'recipient' => $this->message->getRecipient(),
                'body'      => $this->message->getMessageBody()->toArray(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Actor
     */
    public function getActor(): Actor
    {
        return $this->actor;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }
}
