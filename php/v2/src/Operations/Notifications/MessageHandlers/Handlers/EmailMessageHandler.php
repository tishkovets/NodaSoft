<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Handlers;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Email\EmailReport;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Email\FailedEmailReport;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Email\SucceedEmailReport;
use NW\WebService\Operations\Notifications\Messages\Email\EmailMessage;

class EmailMessageHandler extends MessageHandler
{
    /**
     * @param EmailMessage $message
     * @param Actor $actor
     */
    public function __construct(EmailMessage $message, protected Actor $actor)
    {
        parent::__construct($message, $actor);
    }

    /**
     * @return EmailReport
     */
    public function handle(): EmailReport
    {
        try {
            $emailTo   = $this->message->getRecipient();
            $emailFrom = $this->message->getSender();
            $subject   = $this->message->getSubject();
            $body      = $this->message->getBody();

            mail($emailTo, $subject, $body, sprintf('From: %s', $emailFrom), sprintf('-f%s', $emailFrom));

            return new SucceedEmailReport($this->actor, $this->message);
        } catch (\Throwable $e) {
            return new FailedEmailReport($this->actor, $this->message, [
                $e->getMessage(),
                $e->getCode(),
            ]);
        }
    }
}
