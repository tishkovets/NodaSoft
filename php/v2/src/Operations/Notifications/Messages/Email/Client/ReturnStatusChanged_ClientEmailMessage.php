<?php

namespace NW\WebService\Operations\Notifications\Messages\Email\Client;

use NW\WebService\Operations\Notifications\Messages\Email\EmailMessage;

class ReturnStatusChanged_ClientEmailMessage extends EmailMessage
{
    /**
     * @return string
     */
    public function getSubject(): string
    {
        return sprintf('Status has been changed for complaint %s', $this->messageBody->getComplaintId());
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return sprintf('Hello %s :) The status for complaint %s has been changed. Here is details %s ',
            $this->messageBody->getClientIdName(),
            $this->messageBody->getComplaintId(),
            json_encode($this->messageBody->toArray())
        );
    }
}
