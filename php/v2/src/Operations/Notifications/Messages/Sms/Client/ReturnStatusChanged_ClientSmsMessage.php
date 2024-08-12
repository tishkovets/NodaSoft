<?php

namespace NW\WebService\Operations\Notifications\Messages\Sms\Client;

use NW\WebService\Operations\Notifications\Messages\Sms\SmsMessage;

class ReturnStatusChanged_ClientSmsMessage extends SmsMessage
{
    /**
     * @return string
     */
    public function getBody(): string
    {
        return sprintf('Hello %s :) The status for complaint %s has been changed.',
            $this->messageBody->getClientIdName(),
            $this->messageBody->getComplaintId()
        );
    }
}
