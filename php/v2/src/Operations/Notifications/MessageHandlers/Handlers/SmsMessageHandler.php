<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Handlers;

use NW\WebService\Actors\Actor;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Sms\FailedSmsReport;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Sms\SmsReport;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Sms\SucceedSmsReport;
use NW\WebService\Operations\Notifications\Messages\Sms\SmsMessage;

class SmsMessageHandler extends MessageHandler
{
    /**
     * @param SmsMessage $message
     * @param Actor $actor
     */
    public function __construct(SmsMessage $message, protected Actor $actor)
    {
        parent::__construct($message, $actor);
    }

    /**
     * @return SmsReport
     */
    public function handle(): SmsReport
    {
        try {
            $phone = $this->message->getRecipient();
            $body  = $this->message->getBody();

            // send sms here
            // .....

            return new SucceedSmsReport($this->actor, $this->message);
        } catch (\Throwable $e) {
            return new FailedSmsReport($this->actor, $this->message, [
                $e->getMessage(),
                $e->getCode(),
            ]);
        }
    }
}
