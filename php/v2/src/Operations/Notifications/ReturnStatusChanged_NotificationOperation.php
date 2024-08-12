<?php

namespace NW\WebService\Operations\Notification;

use NW\WebService\Exceptions\ClientNotFoundException;
use NW\WebService\Exceptions\CreatorNotFoundException;
use NW\WebService\Exceptions\ExpertNotFoundException;
use NW\WebService\Exceptions\IncorrectInputDataException;
use NW\WebService\Exceptions\ResellerNotFoundException;
use NW\WebService\Helpers\CheckInputDataHelper;
use NW\WebService\Operations\Notifications\MessageBodies\ReturnStatusChanged_MessageBody;
use NW\WebService\Operations\Notifications\MessageHandlers\Reports\Reports;
use NW\WebService\Operations\Notifications\Messages\Email\Client\ReturnStatusChanged_ClientEmailMessage;
use NW\WebService\Operations\Notifications\Messages\Email\Employee\ReturnStatusChanged_EmployeeEmailMessage;
use NW\WebService\Operations\Notifications\Messages\Sms\Client\ReturnStatusChanged_ClientSmsMessage;

final class ReturnStatusChanged_NotificationOperation extends NotificationOperation
{
    /**
     * @return array[]
     * @throws IncorrectInputDataException
     * @throws ClientNotFoundException
     * @throws CreatorNotFoundException
     * @throws ExpertNotFoundException
     * @throws ResellerNotFoundException
     */
    public function process(): array
    {
        // check data
        $filteredData = CheckInputDataHelper::byRequirements(NotificationOperation::REQUIREMENTS, $this->data);
        if (!isset($data['differences'])) {
            throw new IncorrectInputDataException('Not found param: differences');
        } elseif (!is_array($data['differences'])) {
            throw new IncorrectInputDataException('Incorrect param: differences');
        }

        $filteredData['differences'] = CheckInputDataHelper::byRequirements([
            'from' => 'int',
            'to'   => 'int',
        ], $data['differences']);

        // init actors and check them
        $this->initActors($filteredData);

        $this->data = $filteredData + $this->data;

        $reports     = new Reports();
        $messageBody = ReturnStatusChanged_MessageBody::createFrom($this->data);

        // send emails to employees
        $employees   = $this->reseller->getEmployees();
        foreach ($employees as $employee) {
            $message = new ReturnStatusChanged_EmployeeEmailMessage(
                $employee->getEmail(),
                $messageBody,
                $this->reseller->getEmail()
            );
            $report  = $message->handler($employee)->handle();
            $reports->addReport($report);
        }

        // send email to client
        if ($this->client->hasEmail()) {
            $message = new ReturnStatusChanged_ClientEmailMessage(
                $this->client->getEmail(),
                $messageBody,
                $this->reseller->getEmail()
            );
            $report  = $message->handler($this->client)->handle();
            $reports->addReport($report);
        }

        // send sms to client
        if ($this->client->hasPhone()) {
            $message = new ReturnStatusChanged_ClientSmsMessage(
                $this->client->getPhone(),
                $messageBody,
            );
            $report  = $message->handler($this->client)->handle();
            $reports->addReport($report);
        }

        return ['notifications' => $reports->toArray()];
    }
}
