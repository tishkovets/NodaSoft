<?php

namespace NW\WebService\Operations\Notifications\Messages\Email\Employee;

use NW\WebService\Operations\Notifications\Messages\Email\EmailMessage;

class ReturnStatusChanged_EmployeeEmailMessage extends EmailMessage
{
    /**
     * @return string
     */
    public function getSubject(): string
    {
        return sprintf('RETURN STATUS CHANGED %s !!!!', $this->messageBody->getComplaintId());
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return sprintf('details %s ', json_encode($this->messageBody->toArray()));
    }
}
